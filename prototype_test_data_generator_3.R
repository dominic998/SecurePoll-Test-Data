
## This program is free software; you can redistribute it and/or modify
## it under the terms of the GNU General Public License as published by
## the Free Software Foundation; either version 2 of the License, or
## (at your option) any later version.

## This program is distributed in the hope that it will be useful,
## but WITHOUT ANY WARRANTY; without even the implied warranty of
## MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
## GNU General Public License for more details.

## You should have received a copy of the GNU General Public License along
## with this program; if not, write to the Free Software Foundation, Inc.,
## 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
## http://www.gnu.org/copyleft/gpl.html


## This is a slight improvement and generalisation of the first
## prototype. Compared to the first:
## 1. It handles any number of candidates.
## 2. It can simulate any of the candidates 2 to N reallocating votes to
##    candidate 1.
## 3. It simulates one candidate being eliminated from the election (if
##    applicable).

## @param preferences: Output of expand.grid(a:b, c:d, e:f, g:h, ...) which is a
##        dataframe each row of which is a different combination of votes.

##        If there are N candidates, the columns 1 to N contain the number of
##        first preferences for candidates 1 to N respectively.

##        The columns N+1 <= N+i <= 2*N contain the number of voters who chose
##        candidate i as first and candidate 1 as second.

##        Selecting a good preferences argument is a bit of an art-form, some
##        examples are below.

## @param numStages: Number of stages of the election to simulate.

## @param numCandidates: Number of candidates in this election.

## @param numSeats: Number of seats in this election.
optimise <- function(preferences, numStages, numCandidates, numSeats) {

    ## Total votes calculated from the sum of first preferences
    preferences$total <- rowSums(preferences[1:numCandidates])

    preferences$reallocate <- 0
    preferences$excess <- 0
    preferences$eliminated <- numCandidates + 1

    for (i in 1:numStages) {
	preferences$droop <- (preferences$total - preferences$excess) / (numSeats + 1) + 0.000001
	preferences$droopdiff <- preferences$droop - (preferences[[1]] + preferences$reallocate)

        preferences$reallocate <- 0
        preferences$excess <- 0

        for (j in 2:numCandidates) {
            diff <- pmax(0, preferences[[j]] - preferences$droop)
            ## Eliminate candidates N, N-1, ..., N-i (where i = min(numStages - 1, numCandidates - numSeats - 1))
            if (j > numSeats && (numCandidates - j) < i) {
                diff <- preferences[[j]]
                ## Lowest index of eliminated candidates
                preferences$eliminated[preferences$eliminated > j] <- j
            }

            ratioReallocated <- preferences[[j+numCandidates]] / preferences[[j]]
            ratioReallocated[is.na(ratioReallocated) | is.infinite(ratioReallocated)] <- 0
            preferences$reallocate <- preferences$reallocate + diff * ratioReallocated
            preferences$excess <- preferences$excess + diff * (1 - ratioReallocated)
        }

    }

    preferences
}

preferences <- expand.grid(714, 715, 195:198, 198, 198, 198, 198, 198, 198, 198, 198, 198, 198, 199, 199, 199, 199, 199, 199, 199, 0, 284:286, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)

preferences <- optimise(preferences, 5, 20, 6)

## Here is how you could order the data, selecting first preference
## distributions that are close to the top.
head(subset(preferences[order(preferences$droopdiff, preferences$total, decreasing=c(FALSE, TRUE)),], droopdiff > 0), 10)
