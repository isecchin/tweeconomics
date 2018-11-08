name := "tweeconomics"
version := "0.1.0"
scalaVersion := "2.11.8"

libraryDependencies += "org.apache.spark" % "spark-core_2.11"              % "2.1.1"
libraryDependencies += "org.apache.spark" % "spark-streaming_2.11"         % "2.1.1"
libraryDependencies += "org.apache.spark" % "spark-sql_2.11"               % "2.1.1"
libraryDependencies += "org.apache.bahir" % "spark-streaming-twitter_2.11" % "2.1.0"

libraryDependencies += "edu.stanford.nlp" % "stanford-corenlp"             % "3.7.0" artifacts (Artifact("stanford-corenlp", "models"), Artifact("stanford-corenlp"))

libraryDependencies += "org.scalatest"    % "scalatest_2.11"               % "3.0.3" % "test"
