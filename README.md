Step-By-Step Guide:

1. Clone the repository with the following command:
    git clone git@gitlab.com:isecchin/tweeconomics.git
2. Follow these steps to install SBT on your machine (according to your OS):
    http://www.scala-sbt.org/0.13/docs/Setup.html
3. Copy the credentials template file:
    cp credentials.txt.template credentials.txt
4. Edit the credentials.txt file replacing the "{***}" values with actual credential values from the Twitter API.
    vim credentials.txt
5. Run the program using the following command:
    sbt run
6. Upon the first execution, the external libraries will be downloaded and this may take some time, so sit back and take a cup of coffe in the meantime.
