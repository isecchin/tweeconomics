package tweeconomics

import java.io.File

import scala.io.Source
import org.apache.spark.sql.SparkSession
import scala.collection.mutable.HashMap
import scala.collection.mutable.ArrayBuffer
import java.time.format.DateTimeFormatter

object Utils
{
    val dictionaryFileName = "dictionary.json"
    val spark = SparkSession.builder().getOrCreate()

    val dateFormatter = DateTimeFormatter.ofPattern("YYYY-MM-dd HH:mm:ss.SSS")

    /** Configures the OAuth Credentials for accessing Twitter */
    def configureTwitterCredentials() = {
        val file = new File("credentials.txt")
        if (!file.exists) {
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
        val configKeys = Seq("consumerKey", "consumerSecret", "accessToken", "accessTokenSecret")
        Logger.info("Configuring Twitter OAuth...")
        configKeys.foreach(key => {
            if (!map.contains(key)) {
                throw new Exception("Error setting OAuth authenticaion - value for " + key + " not found")
            }
            val fullKey = "twitter4j.oauth." + key
            System.setProperty(fullKey, map(key))
            Logger.info("\tProperty " + fullKey + " set as " + map(key))
        })
    }

    def readJSON(filename: String) = {
        spark.read.json(filename)
    }

    /**
     * I know this is not ideal (we're using collect)
     * but I could not find another way of doing the merge
     * of the filters' array inside the JSON file yet
     *
     * @return Array of all filters
     */
    def getFilters() = {
        val json = readJSON(dictionaryFileName)
        val filtersArray = ArrayBuffer[String]()

        json.collect().foreach(row => {
            filtersArray += row.getAs[String]("filter")
        })

        filtersArray
    }

    /**
     * I know this is not ideal (we're using collect)
     * but I could not find another way of doing the merge
     * of the filters' array inside the JSON file yet
     *
     * @return Array of all filters
     */
    def getFiltersMap() = {
        val json = readJSON(dictionaryFileName)
        val filtersArray = ArrayBuffer[Map[String, String]]()

        json.collect().foreach(row => {
            val company = row.getAs[String]("company")
            val filter  = row.getAs[String]("filter")
            val map = Map("company" -> company, "filter" -> filter)

            filtersArray += map
        })

        filtersArray
    }
}
