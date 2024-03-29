# Natural Language Processing (NLP)

* [Definition](#definition)
* [Steps](#steps)

## Definition

## Turning Text into Tables
<img src="./images/orpd.png" alt="drawing" width="300"/> <br />
<img src="./images/odmc.png" alt="drawing" width="700"/>


## Steps
1. building vocabulary
2. remove punctuation and numbers
3. tokenize (split into individual words)
4. remove stop words
5. apply the hashing trick. <br />
  The hashing trick provides a fast and space-efficient way to map a very large (possibly infinite) set of items onto a smaller, finite number of values.
5. convert to TF-IDF (term frequency–inverse document frequency) representation. <br />
  The TF-IDF matrix reflects how important a word is to each document. It takes into account both the frequency of the word within each document but also the frequency of the word across all of the documents in the collection. The closer IDF of a word is to 0, the more common that word is. 
  
## NLP Preprocessing:
1. remove stop words & punctuations.
2. (if necessary): remove URLs and tweet handles. 
3. tokenize (split into individual words)
4. lower casing all capitals
5. stemming
    1. the process of converting a word to its **most general form**, or **stem**. 
    2. in some cases, the stemming process produces words that are not correct spellings of the root word.
    3. Example: (1) `danc` is the stem for dancer, dancing, danced ; (2) `tun` is the stem for tune, tuned, tuning ; (3) `happi` is the stem for happy, happiness, and happier; (4) `learn` is the stem for learn, learning, learned, learnt.
    4. You can use porter stemmer to take care of this. 
    5. NLTK use `porterstemmer` algorithm for its stemming function. 

## NLP Models:
1. Classification and Vector Spaces
2. Probabilistic Models
3. Sequence Models
4. Attention Models

## Tools & Libraries:

### 1. Python and Pyspark

Libraries:
1. `from pyspark.ml.feature import StopWordsRemover, HashingTF, IDF`
2. `from pyspark.sql.functions import regexp_replace`
3. gensim
4. nltk
    1. `from nltk.corpus import stopwords`.
    2. `from nltk.corpus import twitter_samples`.
    3. `from nltk.stem import PorterStemmer`.
    4. `from nltk.tokenize import TweetTokenizer`.
6. re --> library for regular expression operations. Read more about regex [here](https://www.programiz.com/python-programming/regex). To understand what a regex pattern means, check [regex101.com]https://regex101.com/().
    1. `re.sub(pattern, repl, string)`  --> replaces one or many matches `pattern` in the `string` with `repl`.
8. spacy
9. string --> for string operations.

## NLP & Classification:
1. Got a bunch of texts. It can be tweets, etc. 
2. Create a vocabulary `V` which is the list of unique words from that bunch of texts. This vocabulary will allow us to encode any text or any tweet as an array of numbers.<br />
    <img src="./images/vocabulary.png" alt="drawing" width="600"/>
3. Do feature extraction. Check if every word from your vocabulary appears in the text (tweets, etc). If it does, assign a value of `1` to that word (feature). If it doesn't, assign the value of `0`. This would result in texts represented as vector as depicted in the figure below. <br />
    <img src="./images/word2vec.png" alt="drawing" width="600"/>
4. represent text as a vector --> vector space models
5. build a classifier
    a. logistic regression classifier
    b. naive bayes classifier
