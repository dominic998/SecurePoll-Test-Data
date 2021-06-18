
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


## This is a prototype.

## This function will produce a distribution of first preferences such that the
## first candidate will receive the most votes without reaching the quota.

## It uses principles from recursive optimisation/dynamic programming to
## simulate a number of stages of an STV election such that the difference
## between the number of votes for the first candidate and the quota is as small
## as possible while still being greater than 0 (i.e. quota - first candidate
## votes > 0 but as close to 0 as possible).

## At each stage, any candidates which are elected have their excess votes
## reallocated or removed and the Droop quota is re-calculated. At the moment,
## it assumes only candidate 2's excess votes will be reallocated to candidate
## 1. In the future, this will probably change.

## At the moment, it doesn't simulate candidates being eliminated.

## At the moment, it only support elections with exactly five candidates.

## @param preferences: Output of expand.grid(a:b, c:d, e:f, g:h, i:j) which is a
##        dataframe each row of which is a different combination of voter first
##        preferences for candidates 1-5. Selecting a good preferences argument
##        is a bit of an art-form, some examples are below.

## @param stages: Number of stages of the election to simulate.

## @param seats: Number of seats in this election.

optimise <- function(preferences, stages, seats) {

    preferences$total <- preferences$Var1 + preferences$Var2 + preferences$Var3 + preferences$Var4 + preferences$Var5
    preferences$Var2excess <- 0
    preferences$Var3excess <- 0
    preferences$Var4excess <- 0
    preferences$Var5excess <- 0
    preferences$reallocate <- 0

    for (i in 1:stages) {
	preferences$droop <- (preferences$total - (preferences$Var2excess + preferences$Var3excess + preferences$Var4excess + preferences$Var5excess - preferences$reallocate)) / (seats + 1)
	preferences$droopdiff <- preferences$droop - (preferences$Var1 + preferences$reallocate)

	preferences$Var2excess <- preferences$Var2 - preferences$droop
	preferences$Var2excess[preferences$Var2excess<0] <- 0
	preferences$Var3excess <- preferences$Var3 - preferences$droop
	preferences$Var3excess[preferences$Var3excess<0] <- 0
	preferences$Var4excess <- preferences$Var4 - preferences$droop
	preferences$Var4excess[preferences$Var4excess<0] <- 0
	preferences$Var5excess <- preferences$Var5 - preferences$droop
	preferences$Var5excess[preferences$Var5excess<0] <- 0

	preferences$reallocate <- preferences$Var2excess
    }

    preferences
}

## preferences <- expand.grid(505:515, 510:520, 520:530, 260:270, 260:270)
preferences <- expand.grid(0:10, 0:15, 0:15, 0:5, 0:5)

preferences <- optimise(preferences, 5, 3)
