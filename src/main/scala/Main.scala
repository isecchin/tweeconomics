package tweeconomics

import org.apache.spark._
import org.apache.spark.streaming._
import org.apache.spark.streaming.dstream._
import org.apache.spark.streaming.twitter._

object App {

    Logger.setup()

    val config = new SparkConf().setAppName("tweeconomics").setMaster("local[*]")
    val sc = new SparkContext(config)

    def main(args: Array[String]) = {
        val streaming = new Streaming()
        streaming.setupAnalyzer()
        streaming.start()
    }
}
