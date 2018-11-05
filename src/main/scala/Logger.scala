package tweeconomics

import org.apache.log4j.{Logger => Logger4j}
import org.apache.log4j.{Level  => Level4j}

object Logger {
    def setup() = {
        Logger4j.getLogger("org").setLevel(Level4j.ERROR)
        Logger4j.getLogger("akka").setLevel(Level4j.ERROR)
    }

    def debug(message: String) = {
        println("[DEBUG] " + message)
    }

    def info(message: String) = {
        println("[INFO] " + message)
    }

    def warning(message: String) = {
        println("[WARNING] " + message)
    }

    def error(message: String) = {
        println("[ERROR] " + message)
    }
}
