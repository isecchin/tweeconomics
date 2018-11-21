package tweeconomics

import java.io.File

import scala.io.Source
import org.apache.spark.sql.SparkSession
import scala.collection.mutable.HashMap
import scala.collection.mutable.Map
import scala.collection.mutable.ArrayBuffer
import java.time.format.DateTimeFormatter

object Utils
{
    val dictionaryFileName = "dictionary.json"
    val spark = SparkSession.builder().getOrCreate()

    val dbDateFormatter = DateTimeFormatter.ofPattern("YYYY-MM-dd HH:mm:ss.SSS")
    val twitterDateFormatter = DateTimeFormatter.ofPattern("EEE MMM dd HH:mm:ss zzz yyyy")

    def setupCredentials() = {
        val file = new File("credentials.txt")
        if (! file.exists) {
            throw new Exception("Could not find configuration file " + file)
        }

        val lines = Source.fromFile(file.toString).getLines.filter(_.trim.size > 0).toSeq
        val pairs = lines.map(line => {
            val splits = line.split("=")
            if (splits.size != 2) {
                throw new Exception("Error parsing configuration file - incorrectly formatted line [" + line + "]")
            }
            (splits(0).trim(), splits(1).trim())
        })

        val map = new HashMap[String, String] ++= pairs

        Twitter.configure(map)
        DB.configure(map)
    }

    def readJSON(filename: String) = {
        spark.read.json(filename)
    }

    def getFiltersSeq() = {
        val dictionary = spark.read.jdbc(DB.url, "company_dictionary", DB.properties)
        val filtersArray = ArrayBuffer[String]()

        dictionary.collect().foreach(row => {
            filtersArray += row.getAs[String]("word")
        })

        filtersArray.toSeq
    }

    def getFiltersMap() = {
        val dictionary = spark.read.jdbc(DB.url, "company_dictionary", DB.properties)
        var filters = Map[String, Long]()

        dictionary.collect().foreach(row => {
            filters += (row.getAs[String]("word") -> row.getAs[Long]("company_id"))
        })

        filters
    }
}
