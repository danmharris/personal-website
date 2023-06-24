---
title: Advent of Code
date: "2020-12-01"
active: true
---

[Advent of Code](https://adventofcode.com/) is a yearly series of programming problems which run through December. I use these to brush up on some of my problem solving skills but also to try
out new programming languages. I have particiapted since 2020, though admittedly I have yet to make it all the way to
day 25 yet! I am part of a handful of private leaderboards with friends which not only allows us to engage in some healthy competition, but also talk about our approaches and how we found each problem.

So far I have used the following languages:

## 2020 - Go

https://github.com/danmharris/advent-2020

This was my first year and as such my first exposure to the kinds of problems you get faced with. Whilst I'm a big fan of Go because of its simplicity and syntax, I'm not sure I would use it for rapid problem solving like this because you have to implement a lot of functional paradigms yourself. Things like filtering arrays, mapping data etc. doesn't exist in Go and you have to roll this yourself. I didn't have any shared code this time so if I were to use it again I would definitely pre-write these sort of functions.

## 2021 - Python

https://github.com/danmharris/advent-2021

This year I went with a scripting language as it felt like a more appropriate choice for this kind of problem solving. I also began writing unit tests for the code. Advent of Code problems always have a smaller input data which is perfect for putting in a unit test and quickly finding out if the algorithm works. This isn't foolproof though! Sometimes I had a solution that worked perfectly on the sample data, but either failed on the real data or took forever because I had written an exponential algorithm.

## 2022 - Ruby

https://github.com/danmharris/advent-2022

As my new job used a fair amount of Ruby code this felt like a perfect opportunity to improve my knowledge of the language. Ruby is also very handy as it has a lot of functional operations like maps and filters, and I'm a big fan of the block syntax.

Also for a bit of fun I wrote a scaffolding script that would generate the test function and class for each day, alongside a runner script that would run any day.

And, just to be completely overkill, I added CI to lint and test the code as it was pushed to GitHub. In hindsight linting was probably a mistake as, due to the complexity of some of the problems, I started with some... less than elegant solutions which made the linter unhappy.
