package tweeconomics

import tweeconomics.utils._
import org.apache.spark._
import org.apache.spark.streaming._
import org.apache.spark.streaming.dstream.DStream
import org.apache.spark.streaming.twitter._
import java.time.LocalDateTime
import scala.collection._

case class TweetData(company_id: Long, sentiment_id: Int, posted_at: String)

class Streaming
{
    Utils.setupCredentials()

    val ssc = new StreamingContext(App.sc, Seconds(60))
    val stream = TwitterUtils.createStream(ssc, None, Utils.getFiltersSeq())
    import App.sqlContext.implicits._

    def setupAnalyzer() = {
        val filtersSeq = Utils.getFiltersSeq()
        val filtersMap = Utils.getFiltersMap()

        val tweets = stream
            .filter{status => status.getLang == "en" && filtersSeq.exists(status.getText().contains)}
            .map(status => {
                val text = status.getText()
                val companyId = filtersMap(filtersSeq.filter(text.contains).head)
                val sentiment = SentimentAnalyzer.extractSentiments(text).head
                val postedAt = LocalDateTime.parse(
                  status.getCreatedAt().toString(),
                  Utils.twitterDateFormatter
                ).format(Utils.dbDateFormatter)

                TweetData(companyId, sentiment._2, postedAt)
            })

        tweets.foreachRDD{rdd =>
            val now = LocalDateTime.now()
            val count = rdd.count()
            println(s"Number of tweets in block of time $now: $count")

            rdd.toDF().write.mode("append").jdbc(DB.url, "analyzed_tweets", DB.properties)
        }
    }

    def start() = {
        ssc.start()
        ssc.awaitTermination()
    }
}
