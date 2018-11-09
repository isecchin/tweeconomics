package tweeconomics

import tweeconomics.utils._
import org.apache.spark._
import org.apache.spark.streaming._
import org.apache.spark.streaming.dstream.DStream
import org.apache.spark.streaming.twitter._
import java.time.LocalDateTime
import scala.collection._

case class TweetData(company: String, date: String, sentiment: String)

class Streaming
{
    Utils.setupCredentials()

    val ssc = new StreamingContext(App.sc, Seconds(60))
    val stream = TwitterUtils.createStream(ssc, None, Utils.getFilters())
    import App.sqlContext.implicits._

    def setupAnalyzer() = {
        val filters = Utils.getFiltersMap()
        val tweets = stream
            .filter{status => status.getLang == "en"}
            .map(status => status.getText)

        tweets.foreachRDD{rdd =>
            val now = LocalDateTime.now()
            val dateString = now.format(Utils.dateFormatter)
            val count = rdd.count()
            println(s"Number of tweets in block of time $now: $count")

            val dataList = mutable.MutableList[TweetData]()

            rdd.collect().foreach(tweet => {
                val sentiments = SentimentAnalyzer.extractSentiments(tweet)

                sentiments.foreach(sentiment => {
                    filters.foreach(filter => {
                        if (filter("filter").isSubstringOf(tweet)) {
                            val company = filter("company")
                            val sentimentString = sentiment._2
                            val tweetData = TweetData(company, dateString, sentimentString)
                            dataList += tweetData
                        }
                    })
                })
            })

            dataList.toDF().write.format("parquet").mode("append").save("hdfs://localhost:9000/user/hdfs/tweeconomics/data")
        }
    }

    def start() = {
        ssc.start()
        ssc.awaitTermination()
    }
}
