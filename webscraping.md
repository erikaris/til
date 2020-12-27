## Selectors

Select intended node using css selectors or xpath. 

### css selectors

### xpath

1. start with double slash `//`. Next element use single slash `/`. 
2. specify class, id, css, position, count, etc using **predicate** `[...]`. 

### css selectors vs xpath

| No |                               css selectors                              |                              xpath                             |             explanation             |
|:--:|:------------------------------------------------------------------------:|:--------------------------------------------------------------:|:-----------------------------------:|
| 1  | div > p.blue                                                             | //div/p[@class = "blue"]                                       |                                     |
| 2  | ul.list > li:nth-child(5), ul.list > li:last-child, ul.list > li.special | //ul[@class = "list"]/li[position() > 4 or @class = "special"] |                                     |
| 3  |  p                                                                       | //p                                                            |                                     |
| 4  | body p                                                                   | //body//p                                                      |                                     |
| 5  | html > body p                                                            | /html/body//p                                                  |                                     |
| 6  | div > p                                                                  | //div/p                                                        |                                     |
| 7  |                                                                          | //div[a]                                                       | select 'a' that is a child of 'div' |
| 8  | span > a.external                                                        | //span/a[@class = "external"]                                  |                                     |
| 9  | #special div   or  *#special div                                         | //*[@id = "special"]//div                                      |                                     |
