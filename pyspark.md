# Pyspark Notes. 

## Steps:
1. The first step in using Spark is connecting to a cluster.
    1. cluster --> master - worker. 
    2. Creating the connection is as simple as creating an instance of the `SparkContext` class, with `SparkConf()` constructor.
    3. Spark's core data structure is the Resilient Distributed Dataset (RDD). 
2. Import necessary library
    ```
    # Import SparkSession from pyspark.sql
    from pyspark.sql import SparkSession
    ```
3. create a `SparkSession` object from your `SparkContext` --> think of the `SparkContext` as your connection to the cluster and the `SparkSession` as your interface with that connection.
    ```
    # Create my_spark
   spark = SparkSession.builder.getOrCreate()
    ```
4. Start poking around to see what tables is in your cluster using `spark.catalog.listTables()`. Please note that `spark` is the intance of the SparkSession. 
5. Query something from your data using `spark.sql(query)`.
    ```
    # Don't change this query
    query = "SELECT origin, dest, COUNT(*) as N FROM flights GROUP BY origin, dest"

    # Run the query
    flight_counts = spark.sql(query)
    flight_counts.show()
    ```
6. If necessary, convert the result to Pandas dataframe using `.toPandas()`. 
    ```
    # Convert the results to a pandas DataFrame
    pd_counts = flight_counts.toPandas()

    # Print the head of pd_counts
    print(pd_counts.head())
    ```
