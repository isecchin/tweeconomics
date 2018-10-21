name := "tweeconomics"
version := "0.1.0"
scalaVersion := "2.12.7"

libraryDependencies += "edu.stanford.nlp" % "stanford-corenlp"             % "3.7.0" artifacts (Artifact("stanford-corenlp", "models"), Artifact("stanford-corenlp"))

libraryDependencies += "org.scalatest"    % "scalatest_2.11"               % "3.0.3" % "test"
