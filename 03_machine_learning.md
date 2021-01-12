# Machine Learning

## Definition:

1. ....
2. It's all about building a model for ML activities:
    1. Classification
    2. Clustering
    3. ...

## Classification:

1. Definition: ....
2. How?
    1. Decision Trees. 
    2. Logistic Regression
        1. make a binary predicition.

## Steps for building a model

1. Split the data into `training data` and `testing data`. 
2. Build model using the appropriate methods --> **fit and transform**. 
3. Use the model to make prediction
4. Evaluate the model. 

## Methods for building model:

### Decision Trees

1. concept: iterative splits

### Logistic Regression

## Tools:

## Evaluating a Model

1. Confusion Matrix and Accuracy. <br />

    ![Alt text](./confusion_matrix.png) <br />
    *Image is taken from [researchgate.net](https://www.researchgate.net/figure/Confusion-Matrix-Example-Confusion-matrix-terminology-True-positive-Positively-predicted_fig4_328567484)*

    A confusion matrix gives a useful breakdown of predictions versus known values. It has four cells which represent the counts of:
    1. True Negatives (TN) — model predicts negative outcome & known outcome is negative
    2. True Positives (TP) — model predicts positive outcome & known outcome is positive
    3. False Negatives (FN) — model predicts negative outcome but known outcome is positive
    4. False Positives (FP) — model predicts positive outcome but known outcome is negative.
    
    **Accuracy** = (TN + TP) / (TN + TP + FN + FP)
    
2. Precision and Recall 
    1. Precision = TP / (TP + FP) --> proportion of positive predictions which are correct. *For all flights which are predicted to be delayed, what proportion is actually delayed?*
    2. Recall = TP / (TP + FN) --> proportion of positives outcomes which are correctly predicted. *For all delayed flights, what proportion is correctly predicted by the model?*

3. Receiver Operating Characteristic (ROC) <br />
    ![Alt text](./images/roc.png) <br />
    
    1. a curve describing TP versus FP
    2. threshold = 0 (top right) and 1 (bottom left). 
    3. area under ROC is called **area under the curve (AUC)**. 
    4. ideally, AUC = 1. 

