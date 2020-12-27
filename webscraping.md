## Selectors

| No |                               css selectors                              |                              xpath                             |
|:--:|:------------------------------------------------------------------------:|:--------------------------------------------------------------:|
|  1 | div > p.blue                                                             | //div/p[@class = "blue"]                                       |
|  2 | ul.list > li:nth-child(5), ul.list > li:last-child, ul.list > li.special | //ul[@class = "list"]/li[position() > 4 or @class = "special"] |
|  3 |  p                                                                       | //p                                                            |
|  4 | body p                                                                   | //body//p                                                      |
|  5 | html > body p                                                            | /html/body//p                                                  |
|  6 | div > p                                                                  | //div/p                                                        |
