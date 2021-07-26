
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

candidates <- c(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20)
numSeats <- 4
totalVotes <- 5000
## distribution <- dbinom(1:20, 20, 0.5)
distribution <- dunif(1:20, 1, 20)

for (j in 1:100) {

    ballots <- list()
    for (i in 1:totalVotes) {
        ballots[[i]] <- sample(1:length(candidates), sample(1:length(candidates), 1), replace=FALSE, distribution)
    }

    randomInt <- sample(1:9999999999, 1)
    filename <- sprintf("%s_%s_%s_%s.blt", length(candidates), numSeats, totalVotes, randomInt)

    writeBallot(filename, ballots, candidates, numSeats, totalVotes)

}
