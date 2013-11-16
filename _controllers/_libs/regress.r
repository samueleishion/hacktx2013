#!/bin/bash
# r --slave -f regress.r
#

file = "C:\\xampp\\htdocs\\_controllers\\_libs\\data.txt"

#dataframe 
df = read.table(file, header = T, sep = "\t")

# response variables sentimentP(pos prob), sentimentN (neg prob), sentimentE (neutral prob)
sentiment_P = df$P(nos)
sentiment_N = df$P(neg)
sentiment_E = df$P(neut)

#explanatory variable couting the number of adjectives 
adj_count = df$adj

#response variable highest probability 
highest_prob = df$highest

#explantatory varibale: number of likes 
count_likes = df$likes

#Regression for sentiment probs and adjectives 
regress_adjP = cor(adj_count, sentiment_P, method = "pearson")
regress_adjN = cor(adj_count, sentiment_N, method = "pearson")
regress_adjE = cor(adj_count, sentiment_E, method = "pearson")

#Regression for highest sentiment prob and likes
regress_lh = cor(count_likes, highest_prob, method = "pearson")

#Finds the biggest r value out of all 3
prob_values = c(regress_adjP,regress_adjN,regress_adjE)
biggest_prob =max(prob_values)

cat(biggest_prob*regress_lh)


