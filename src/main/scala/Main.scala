package tweeconomics

import org.apache.spark._
import org.apache.spark.sql._
import org.apache.spark.streaming._
import org.apache.spark.streaming.dstream._
import org.apache.spark.streaming.twitter._

object App
{
    Logger.setup()

    val config = new SparkConf().setAppName("tweeconomics").setMaster("local[*]")
    val sc = new SparkContext(config)
    val sqlContext = new SQLContext(sc)
    import sqlContext.implicits._

    def main(args: Array[String]) = {
        val streaming = new Streaming()

        streaming.setupAnalyzer()
        streaming.start()
    }
}
