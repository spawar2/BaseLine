library(shiny)
server <- function(input, output) {
  
  
  output$plot1 <- renderPlot({ 
  	
  	    inFile <- input$file1
    if (is.null(inFile))
      {return(NULL)}
      
      else {
   df = read.csv(inFile$datapath)	
 library("tibble")
 library(shazam)
 library(readr)
#MyData <- read.csv("MyData.csv", header=TRUE, sep=",")
my_data <- as_tibble(df)
my_data <- as_tibble(lapply(my_data, as.character))

db <- collapseClones(my_data, sequenceColumn="SEQUENCE_IMGT",
germlineColumn="GERMLINE_IMGT_D_MASK",
method="thresholdedFreq", minimumFrequency=0.6,
includeAmbiguous=FALSE, breakTiesStochastic=FALSE)

baseline <- calcBaseline(db, 
sequenceColumn="CLONAL_SEQUENCE",
germlineColumn="CLONAL_GERMLINE", 
testStatistic="focused",
regionDefinition=IMGT_V,
targetingModel=HH_S5F,
nproc=1)

grouped1 <- groupBaseline(baseline, groupBy="SAMPLE")
sample_colors <- c("-1h"="steelblue", "+7d"="firebrick")

stats <- summarizeBaseline(grouped1, returnType="df")
p1 <- plotBaselineDensity(grouped1, idColumn="SAMPLE", colorValues=sample_colors, sigmaLimits=c(-1, 1), title = "groupBaseline")	
}
  }) 


output$plot2 <- renderPlot({

		inFile2 <- input$file2
    if (is.null(inFile2))
      {return(NULL)}
      
      else {	
 library("tibble")
 library(shazam)
 library(readr)
df2 = read.csv(inFile2$datapath)
my_data2 <- as_tibble(df2)
my_data2 <- as_tibble(lapply(my_data2, as.character))

db2 <- collapseClones(my_data2, sequenceColumn="SEQUENCE_IMGT",
germlineColumn="GERMLINE_IMGT_D_MASK",
method="thresholdedFreq", minimumFrequency=0.6,
includeAmbiguous=FALSE, breakTiesStochastic=FALSE)

baseline2 <- calcBaseline(db2, 
sequenceColumn="CLONAL_SEQUENCE",
germlineColumn="CLONAL_GERMLINE", 
testStatistic="focused",
regionDefinition=IMGT_V,
targetingModel=HH_S5F,
nproc=1)
grouped2 <- groupBaseline(baseline2, groupBy="ISOTYPE")
test <- testBaseline(grouped2, groupBy="ISOTYPE")
print(test)
p2 <- plot(grouped2, "ISOTYPE", title = "testBaseline")	
}	
})


output$plot3 <- renderPlot({

		inFile2 <- input$file2
    if (is.null(inFile2))
      {return(NULL)}
      
      else {	
 library("tibble")
 library(shazam)
 library(readr)
df2 = read.csv(inFile2$datapath)
my_data2 <- as_tibble(df2)
my_data2 <- as_tibble(lapply(my_data2, as.character))

db2 <- collapseClones(my_data2, sequenceColumn="SEQUENCE_IMGT",
germlineColumn="GERMLINE_IMGT_D_MASK",
method="thresholdedFreq", minimumFrequency=0.6,
includeAmbiguous=FALSE, breakTiesStochastic=FALSE)

baseline2 <- calcBaseline(db2, 
sequenceColumn="CLONAL_SEQUENCE",
germlineColumn="CLONAL_GERMLINE", 
testStatistic="focused",
regionDefinition=IMGT_V,
targetingModel=HH_S5F,
nproc=1)

grouped3 <- groupBaseline(baseline2, groupBy=c("SAMPLE", "ISOTYPE"))
isotype_colors <- c("IgM"="darkorchid", "IgD"="firebrick", 
"IgG"="seagreen", "IgA"="steelblue")
plotBaselineDensity(grouped3, "SAMPLE", "ISOTYPE", colorValues=isotype_colors, 
colorElement="group", sigmaLimits=c(-1, 1), title = "plotBaselineDensity")
}	
})


output$plot4 <- renderPlot({

		inFile2 <- input$file2
    if (is.null(inFile2))
      {return(NULL)}
      
      else {	
 library("tibble")
 library(shazam)
 library(readr)
df2 = read.csv(inFile2$datapath)
my_data2 <- as_tibble(df2)
my_data2 <- as_tibble(lapply(my_data2, as.character))

db2 <- collapseClones(my_data2, sequenceColumn="SEQUENCE_IMGT",
germlineColumn="GERMLINE_IMGT_D_MASK",
method="thresholdedFreq", minimumFrequency=0.6,
includeAmbiguous=FALSE, breakTiesStochastic=FALSE)

baseline2 <- calcBaseline(db2, 
sequenceColumn="CLONAL_SEQUENCE",
germlineColumn="CLONAL_GERMLINE", 
testStatistic="focused",
regionDefinition=IMGT_V,
targetingModel=HH_S5F,
nproc=1)

grouped3 <- groupBaseline(baseline2, groupBy=c("SAMPLE", "ISOTYPE"))
isotype_colors <- c("IgM"="darkorchid", "IgD"="firebrick", 
"IgG"="seagreen", "IgA"="steelblue")
plotBaselineSummary(grouped3, "SAMPLE", "ISOTYPE", groupColors=isotype_colors, title = "plotBaselineSummary")
}	
})





datasetInput <- reactive({
    switch(input$dataset,
           "BASELINe statistics" = stats)
  })
          
output$downloadData <- downloadHandler(
  filename <- function() {
    paste(input$dataset, ".csv", sep = "")
  },

  content <- function(file) {
    write.csv(datasetInput(), file, row.names = FALSE)
  } 
)
            
}
