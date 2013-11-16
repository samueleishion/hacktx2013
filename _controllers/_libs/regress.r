#!/bin/bash
# r --slave -f regress.r
#

file = "data.txt"

#dataframe 
df = read.table(file, header = T, sep = "\t")

# response variables sentimentP(pos prob), sentimentN (neg prob), sentimentE (neutral prob)
sentiment_P = df$Ppos
sentiment_N = df$Pneg
sentiment_E = df$Pneut

#explanatory variable couting the number of adjectives 
adj_count = df$Adj

#response variable highest probability 
highest_prob = df$Highest

#explantatory varibale: number of likes 
count_likes = df$Likes

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


