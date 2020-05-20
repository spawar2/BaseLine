library(ggbeeswarm)
library(ggplot2)
haiStudy <- read.csv("demosaved.csv")

p <- ggplot(haiStudy,
            aes(x=s.accession, y=p.age, colour = p.gender)) +
  geom_quasirandom(method = "tukeyDense") +
  theme(axis.text.x = element_text(angle = 90)) +
  xlab("Study Accession")+ylab("Subject Age")+
  labs(colour = "Gender")

  geom_point()

ggsave(plot = p,
       filename = "test.png",
       path = "plots",
       device = "png")
