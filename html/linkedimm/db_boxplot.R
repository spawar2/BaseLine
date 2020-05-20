#args <- commandArgs(TRUE)
library(ggplot2)
haiStudy <- read.csv("/Applications/AMPPS/www/linkedimmDashBoard/demosaved.csv")

#studyaccession<-args[1]


p <- ggplot(haiStudy,
            aes(x=s.accession, y=p.age, color='red')) +
  geom_boxplot(outlier.colour = NA) +
  theme(axis.text.x = element_text(angle = 90)) +
  geom_point()

p


ggsave(plot = p,
       filename = "test.png",
       path = "/Applications/AMPPS/www/linkedimmDashBoard",
       device = "png")
