# Shrikant pawar, 05/01/2020, BASELINe portal for Dr. Kleinstein and Sussana

library(shiny)
ui <- fluidPage(

  # App title ----
  titlePanel("BASELINe"),
  h3("Bayesian Estimation of Antigen-Driven Selection in Immunoglobulin Sequences"),
    h5("BASELINe, a new computational framework for Bayesian estimation of Antigen-driven selection in Immunoglobulin sequences, provides a more intuitive means of analyzing selection by actually quantifying it.

Operating in log-odds ratio space, the approach also allows, for the first time, comparative analysis between groups of independent sequences. The results of the analysis are summarized in a table and various plots, all of which may be downloaded for further processing."),
  sidebarLayout(
    sidebarPanel(
      fileInput("file1", "Choose a CSV file for Bayesian Estimation",
        accept = c(
          "text/csv",
          "text/comma-separated-values,text/plain",
          ".csv")
        ),  
        
              fileInput("file2", "Choose a CSV file for testBaseline, plotBaselineDensity & plotBaselineSummary",
        accept = c(
          "text/csv",
          "text/comma-separated-values,text/plain",
          ".csv")
        ),        
                    # Input: Choose dataset ----
      selectInput("dataset", "Dataset to download:",
                  choices = c("BASELINe statistics")),

      # Button
      downloadButton("downloadData", "Download")
      
    ),
    mainPanel(
    h6("Instructions for usage: 1) upload the CSV file for estimating calcBaseline, the BASELINe posterior probability density functions (PDFs) for sequences in the given Change-O data frame. 2) groupBaseline convolves groups of BASELINe posterior probability density functions (PDFs) to get combined PDFs for each group 3) summarizeBaseline calculates BASELINe statistics such as the mean selection strength (mean Sigma), the 95% confidence intervals and p-values for the presence of selection 4) testBaseline performs a two-sample signifance test of BASELINe posterior probability density functions (PDFs) 5) plotBaselineDensity plots the probability density functions resulting from selection analysis using the BASELINe method 6) plotBaselineSummary plots a summary of the results of selection analysis using the BASELINe method."),
      plotOutput("plot1"), 
      plotOutput("plot2"),
      plotOutput("plot3"),
      plotOutput("plot4"),
      hr(),   
    print("Portal Contact: Dr. Steven Kleinstein; steven.kleinstein@yale.edu; Kleinstein Lab: 203-785-3891, 300 George Street, Suite 505, New Haven, CT 06511."),
    
       print("For further information on the methods, or if you use the results of this website, please cite the following papers:

1. Gur Yaari; Mohamed Uduman; Steven H. Kleinstein. Quantifying selection in high-throughput Immunoglobulin sequencing data sets. Nucleic Acids Res. 2012 May 27.

2. Mohamed Uduman; Gur Yaari; Uri Hershberg; Mark J. Shlomchik; Steven H. Kleinstein. Detecting selection in immunoglobulin sequences. Nucleic Acids Res. 2011 Jul;39(Web Server issue):W499-504."),
    )
  )
)
