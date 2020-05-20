setwd('output')
args <- commandArgs(TRUE)
 
## Input Simulation parameters

nbeds<-as.integer(args[1])   ## number of beds
myrep<-as.integer(args[2])    ## number of repetitions
period<-as.integer(args[3]) ## run for two years 
myIAT<-as.numeric(args[4]) ## Inter Arrival Time (in Days) 

MyDataPlot<-grid.arrange(p1, p2, p3,p4, ncol=2)

png(filename="output/output.png", width = 800, height = 600)
plot(MyDataPlot)
dev.off()

sink('analysis-output.txt', append=FALSE, type = c("output", "message"))
