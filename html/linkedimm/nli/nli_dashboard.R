#args <- commandArgs(TRUE)
library(ggplot2)
haiStudy <- read.csv("queryresult.csv")

#studyaccession<-args[1]


p <- ggplot(haiStudy,
            aes(x=s.accession, y=p.age)) +
  geom_boxplot(outlier.colour = NA) +
  theme(axis.text.x = element_text(angle = 90)) +
  xlab("Study Accession")+ylab("Subject Age")+
    geom_point()
ggsave(plot = p,
       filename = "nli_plot.png",
       path = "images",
       device = "png")
