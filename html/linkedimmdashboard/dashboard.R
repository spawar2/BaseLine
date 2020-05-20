
library(ggplot2)
library(ggbeeswarm)
haiStudy <- read.csv("demosaved.csv")



p <- ggplot(haiStudy,
            aes(x=s.accession, y=p.age,shape=p.gender ,colour = p.gender)) +
  geom_quasirandom(method = "tukey") +
  theme(plot.title = element_text(color="blue", size=14, face="bold",hjust = 0.5),plot.margin = margin(4,0.5,4,0.5, "cm"),axis.text.x = element_text(angle = 90, face = "italic", color = "blue", size = 7),panel.grid.major = element_blank(), panel.grid.minor = element_blank(),
panel.background = element_blank(),legend.title = element_blank()) +
   xlab("Study Accession")+ylab("Subject Age")+labs(title="A. Scatter plot of study by subject age")+
  geom_point() +scale_shape_manual(values=c(3, 16))+scale_color_manual(values=c('red','blue'))

q <- ggplot(haiStudy, aes(x=factor(1), fill=p.race))+ geom_bar(width = 1)+ labs(title="B. Venn plot of selected subjects race",x = "", y = "", colour = "") + theme(plot.title = element_text(color="blue", size=14, face="bold",hjust = 0.5),plot.margin = margin(4,0.5,4,0.5, "cm"),axis.title.y=element_blank(), axis.text.y=element_blank(), axis.ticks.y=element_blank(), axis.text.x = element_text(angle = 0, face = "italic", color = "blue", size = 10),panel.grid.major = element_blank(), panel.grid.minor = element_blank(), panel.background = element_blank(),legend.title = element_blank())+ coord_polar("y")

r <- ggplot(haiStudy, aes(x=factor(1), fill=p.gender))+ geom_bar(width = 1)+ labs(title="C. Venn plot of selected subjects gender",x = "", y = "", colour = "") + theme(plot.title = element_text(color="blue", size=14, face="bold",hjust = 0.5),plot.margin = margin(4,0.5,4,0.5, "cm"),axis.title.y=element_blank(), axis.text.y=element_blank(), axis.ticks.y=element_blank(), axis.text.x = element_text(angle = 0, face = "italic", color = "blue", size = 10),panel.grid.major = element_blank(), panel.grid.minor = element_blank(), panel.background = element_blank(),legend.title = element_blank())+ coord_polar("y")


ggsave(plot = p,
       filename = "main.png",
       path = "images",
       device = "png")


ggsave(plot = q,
       filename = "main2.png",
       path = "images",
       device = "png")

ggsave(plot = r,
       filename = "main3.png",
       path = "images",
       device = "png")
