
library(ggbeeswarm)
library(ggplot2)
haiStudy <- read.csv("/var/www/html/linkedimmdashboard/demosaved.csv")

#studyaccession<-args[1]


p <- ggplot(haiStudy,
            aes(x=s.accession, y=p.age, colour = p.gender)) +
  geom_quasirandom(method = "tukeyDense") +
  theme(axis.text.x = element_text(angle = 90)) +
  geom_point()
p