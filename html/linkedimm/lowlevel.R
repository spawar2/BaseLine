#args <- commandArgs(TRUE)
library(plotly)
library(ggplot2)
haiStudy <- read.csv("~/Downloads/export.csv")

#studyaccession<-args[1]

str(haiStudy)
p <- ggplot(haiStudy,
            aes(x = p.accession , y = as.numeric(r1.value),
                fill = factor(b1.timepoint, levels = c(0, 28)))) +
  geom_boxplot(outlier.colour = NA) +
  theme(axis.text.x = element_text(angle = 90))

p
