
writeBallot <- function(filename, ballots, candidates, numSeats, totalVotes) {
    sink(filename)

    cat(sprintf("%s %s", length(candidates), numSeats))
    cat("\n")
    for (i in 1:totalVotes) {
        cat("1")
        for (cand in ballots[[i]]) {
            if (!is.na(cand)) {
                cat(" ")
                cat(cand)
            }
        }
        cat(" 0")
        cat("\n")
    }
    cat("0")
    cat("\n")
    for (candidate in candidates) {
        cat("\"")
        cat(candidate)
        cat("\"")
        cat("\n")
    }
    cat("\"")
    cat("ElectionTitle")
    cat("\"")
    cat("\n")

    sink()
}

candidates <- c(1, 2, 3, 4, 5)
numSeats <- 3
totalVotes <- 164
## distribution <- dbinom(1:20, 20, 0.5)
## distribution <- dunif(1:20, 1, 20)
## distribution <- dnorm(1:20, 10, 1)

## stackoverflow-com-2011-election-results_2.csv comes from here: https://github.com/dominic998/SecurePoll-Test-Data/blob/main/test_data/stackoverflow-com-2011-election-results_2.csv
## so2011_2 <- read.csv("stackoverflow-com-2011-election-results_2.csv", header=FALSE)
m_so2010 <- read.csv("../math-stackexchange-com-2010-election-results.blt.csv", header=TRUE)
distribution <- table(m_so2010$f)

for (j in 1:100) {

    ballots <- list()
    for (i in 1:totalVotes) {
        ballots[[i]] <- sample(1:length(candidates), sample(1:3, 1), replace=FALSE, distribution)
    }

    randomInt <- sample(1:9999999999, 1)
    filename <- sprintf("%s_%s_%s_%s.blt", length(candidates), numSeats, totalVotes, randomInt)

    writeBallot(filename, ballots, candidates, numSeats, totalVotes)

}
