package tweeconomics

import java.io.File
import scala.collection.mutable.HashMap

object DB
{
    val properties = new java.util.Properties
    val url = null

    def configureProperties() = {
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
        val dbPropertyKeys = Seq("dbUrl", "dbUser", "dbPassword")
        Logger.info("Configuring Twitter OAuth...")
        dbPropertyKeys.foreach(key => {
            if (! map.contains(key)) {
                throw new Exception("Error setting DB credentials - value for " + key + " not found")
            }
        })

        properties.setProperty("driver", "com.mysql.cj.jdbc.Driver")
        properties.setProperty("user", map.get("dbUser"))
        properties.setProperty("password", map.get("dbPassword"))

        url = map.get("dbUrl")
    }
}
