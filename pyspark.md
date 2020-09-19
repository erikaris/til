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
    
7. convert from Pandas dataframe to Spark dataframe, using `spark.createDataFrame(pandas_df)`. <br />
    However, the output of this method is stored locally, not in the `SparkSession` catalog. This means that you can use all the Spark DataFrame methods on it, but you can't access the data in other contexts. <br />
    For example, a SQL query (using the `.sql()` method) that references your DataFrame will throw an error. <br />
    To access the data in this way, you have to save it as a temporary table using the method `.createOrReplaceTempView()`. See the illustration below. 
    ![Alt text](./spark_figure.png)

8. read a csv file: `spark.read.csv(file_path, header=True)`. 

## About Spark DataFrame

1. Spark DataFrame is **immutable**. This means that it can't be changed, and so columns **can't be updated in place**. 

2. To overwrite the original DataFrame you must **reassign** the returned DataFrame using the method like so:
    ```
    df = df.withColumn("newCol", df.oldCol + 1)
    ```

3. Do a column-wise operation --> use `.withColumn()`. 
