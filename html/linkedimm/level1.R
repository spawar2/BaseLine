#args <- commandArgs(TRUE)
library(plotly)
library(tidyverse)
haiStudy <- read.csv("~/Desktop/haisheets/level1.csv")

#studyaccession<-args[1]

str(haiStudy)
p <- ggplot(filter(haiStudy, b1.timepoint == 0),
            aes(x = p.accession, y = as.numeric(r1.value),
                fill = factor(b1.timepoint, levels = c(0)))) +
  guides(fill=guide_legend(title="Time Points (In Days)"))+
  
  xlab("Study Accession")+ylab("Subject Age")+
  geom_boxplot(outlier.colour = NA) +
  theme(axis.text.x = element_text(angle = 90)) +
  #facet_grid(r1.strain~.)
  facet_wrap(r1.strain~., ncol=1)

p
