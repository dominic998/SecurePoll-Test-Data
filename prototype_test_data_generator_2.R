
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
    previousDroop <- 0

    for (i in 1:numStages) {
	preferences$droop <- (preferences$total - preferences$excess) / (numSeats + 1)
	preferences$droopdiff <- preferences$droop - (preferences[[1]] + preferences$reallocate)

        preferences$reallocate <- 0
        preferences$excess <- 0

        ## Index of candidate with lowest votes
        lowest <- apply(preferences[1:numCandidates], 1, which.min)

        for (j in 2:numCandidates) {
            diff <- pmax(0, preferences[[j]] - preferences$droop)
            ## Simulate eliminating candidate with lowest votes
            diff[preferences$droop == previousDroop & lowest == j] <- preferences[[j]][preferences$droop == previousDroop & lowest == j]

            thingy <- preferences[[j+numCandidates]] / preferences[[j]]
            thingy[is.na(thingy) | is.infinite(thingy)] <- 0
            preferences$reallocate <- preferences$reallocate + diff * thingy
            preferences$excess <- preferences$excess + diff * (1 - thingy)
        }

        previousDroop <- preferences$droop
    }

    preferences
}

preferences <- expand.grid(0:2, 0:2, 0:2, 0:2, 0:2, 0, 0:2, 0:2, 0:2, 0:2)

preferences <- optimise(preferences, 5, 5, 3)

preferences$numElected <- rowSums(preferences[1:5] > preferences$droop)

## Here is how you could order the data, selecting first preference
## distributions that are close to the top.
head(subset(preferences[order(preferences$droopdiff, preferences$total, decreasing=c(FALSE, TRUE)),], droopdiff > 0 & numElected < 3), 10)
