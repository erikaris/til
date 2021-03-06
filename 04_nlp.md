# Natural Language Processing (NLP)

## Definition

## Turning Text into Tables
![Alt text](./images/orpd.png) <br /><br />
![Alt text](./images/odmc.png)


## Steps
1. remove punctuation and numbers
2. tokenize (split into individual words)
3. remove stop words
4. apply the hashing trick. <br />
  The hashing trick provides a fast and space-efficient way to map a very large (possibly infinite) set of items onto a smaller, finite number of values.
5. convert to TF-IDF (term frequency–inverse document frequency) representation. <br />
  The TF-IDF matrix reflects how important a word is to each document. It takes into account both the frequency of the word within each document but also the frequency of the word across all of the documents in the collection. The closer IDF of a word is to 0, the more common that word is. 

## Tools:

### 1. Python and Pyspark

Libraries:
1. `from pyspark.ml.feature import StopWordsRemover, HashingTF, IDF`
2. `from pyspark.sql.functions import regexp_replace`
