# Pyspark Notes. 

## Steps:

1. The **SparkContext**. <br />
    The first step in using Spark is connecting to a cluster.
    1. cluster --> master - worker. 
    2. Creating the connection is as simple as creating an instance of the `SparkContext` class, with `SparkConf()` constructor.
    3. Spark's core data structure is the Resilient Distributed Dataset (RDD). 
    4. SparkContext or `sc` has several properties such as `sc.version`, `sc.pythonVer`, `sc.master`.
    
2. Import necessary library
    ```
    # Import SparkSession from pyspark.sql
    from pyspark.sql import SparkSession
    ```
    
3. The **SparkSession** <Br />
    create a `SparkSession` object from your `SparkContext` --> think of the `SparkContext` as your connection to the cluster and the `SparkSession` as your interface with that connection.
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

1b. Create spark dataframe using `spark.table()`

2. To overwrite the original DataFrame you must **reassign** the returned DataFrame using the method like so:
    ```
    df = df.withColumn("newCol", df.oldCol + 1)
    ```

3. Do a column-wise operation --> use `.withColumn("column_name")`. 

4. Filtering a spark dataframe based on certain characteristics.
    1. use `.filter("sql_string")` --> example: `flights.filter("air_time > 120")`.
    2. use `.filter(Spark Column of boolean)` --> example: `flights.filter(flights.air_time > 120)`.
    
5. Spark only handles numeric data. That means all of the columns in your DataFrame must be either integers or decimals (called 'doubles' in Spark).

## Other functions

1. Aggregating --> The GroupedData methods --> must be preceded by `.groupBy()`.
    1. ```df.groupBy().min("col").show()```
    2. ```df.groupBy().max("col").show()```
    3. ```df.groupBy().count("col").show()``` <br />
    4. `.avg()` --> `flights.filter("carrier == 'DL'").filter("origin == 'SEA'").groupBy().avg("air_time").show()`. 
2. `.cast()`  --> convert all the appropriate columns from your DataFrame model_data to integers. 
3. `.parallelize()` --> load internal-source data into a spark dataframe. Example: <br />
    ```
    numb = range(1, 100)
    spark_data = sc.parallelize(numb)
    
    RDD = sc.parallelize(["Spark", "is", "a", "framework", "for", "Big Data processing"])
    ```
4a. `.textFile(minPartitions = 5)` --> Create an RDD file from a local file consists of 5 partitions. Example: `lines = sc.textFile(file_path)` or `lines = sc.textFile(/usr/local/share/datasets/README.md')`

4b. `spark.createDataFrame` --> Create a Spark dataframe. Please note that we use the object `spark` instead of `sc`. 

5. `.getNumPartitions()` --> check the number of partitions in an RDD file. Example: `fileRDD.getNumPartitions()`.
6. `.collect()` --> retrieve all the elements of the dataset from all nodes to the driver node. `.collect()` is usually used after `filter()`, `group()`, `count()`, `map()`, etc. 
7. `.reduceByKey()` --> operates on key, value (k,v) pairs, then combine & merges the values for each key <br />
    Example:
    ```
    # Create PairRDD Rdd with key value pairs
    Rdd = sc.parallelize([(1,2), (3,4), (3,6), (4,5)])

    # Apply reduceByKey() operation on Rdd
    Rdd_Reduced = Rdd.reduceByKey(lambda x, y: x + y)

    # Iterate over the result and print the output
    for num in Rdd_Reduced.collect(): 
      print("Key {} has {} Counts".format(num[0], num[1]))
    ```
    
    Output:
    ```
    Key 1 has 2 Counts
    Key 3 has 10 Counts
    Key 4 has 5 Counts
    ```
    
## Map vs flatMap

1. `.map()` --> one-to-one transformation <br />
    Example: 
    ```
    # Square all numbers in my_list
    squared_list_lambda = list(map(lambda x: x**2, my_list))
    
    # Create map() transformation to cube numbers
    cubedRDD = numbRDD.map(lambda x: x**3)
    ```
2. `.flatMap()` --> one-to [0, 1, many] transformation. <br />
    Example:
    ```
    # Split the lines of baseRDD into words
    splitRDD = baseRDD.flatMap(lambda x: x.split())
    ````
3. 

