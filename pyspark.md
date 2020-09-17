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
    my_spark = SparkSession.builder.getOrCreate()
    ```
    1. Once you've created a SparkSession, you can start poking around to see what data is in your cluster. 
    2. `SparkSession` has an attribute called `catalog` which lists all the data inside the cluster. This attribute has a few methods for extracting different pieces of information. 
    3. For example, `.listTables()` method, which returns **the names of all the tables in your cluster** as a list.
