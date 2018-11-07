package tweeconomics

import org.apache.spark._
import org.apache.spark.streaming._
import org.apache.spark.streaming.dstream._
import org.apache.spark.streaming.twitter._

class Streaming {

class Streaming
{
    Utils.configureTwitterCredentials()

    val ssc = new StreamingContext(App.sc, Seconds(1))
    val stream = TwitterUtils.createStream(ssc, None)

    def setupAnalyzer() = {
        val tweets = stream.filter{status => status.getLang == "en"}.map{status =>
            status.getText
        }

        tweets.countByValue().foreachRDD{rdd =>
            rdd.foreach(tweet => {
                SentimentAnalyzer.extractSentiments(tweet._1).foreach(println)
            })
        }
    }

    def start() = {
        ssc.start()
        ssc.awaitTermination()
    }
}
