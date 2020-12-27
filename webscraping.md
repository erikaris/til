## Tools

1. R --> rvest, rselenium
2. python --> scrapy, beautiful soup. 

## Extracting function
1. html_node()
2. html_nodes()
3. html_text()
4. html_table()

All the function above can be combined together. Example: 
```
# extracting table from html
mytable <- myhtml %>% 
  html_node(xpath = "//table") %>% 
  html_table()
# Print the contents of the role data frame
print(mytable)
```

## Selectors

Select intended node using css selectors or xpath. 

### css selectors

### xpath

1. start with double slash `//`. Next element use single slash `/`. 
2. specify class, id, css, position, count, etc using **predicate** `[...]`. 

### css selectors vs xpath

| No 	|                               css selectors                              	|                                              xpath                                              	|                                               explanation                                              	|
|:--:	|:------------------------------------------------------------------------:	|:-----------------------------------------------------------------------------------------------:	|:------------------------------------------------------------------------------------------------------:	|
|  1 	| div > p.blue                                                             	| //div/p[@class = "blue"]                                                                        	| - [..] = predicate<br>- @ for class                                                                    	|
|  2 	| ul.list > li:nth-child(5), ul.list > li:last-child, ul.list > li.special 	| //ul[@class = "list"]/li[position() > 4 or @class = "special"]                                  	| position() =, < , <=, >, >=, !=<br><br>--> for selecting the nth element<br>--> position starts from 1 	|
|  3 	|                                                                          	| - //ol/li[position() != 3 and @class = "blue"]<br>- //ol/li[position() != 3 or @class = "blue"] 	| combining xpath: 'and', 'or'                                                                           	|
|  4 	|  p                                                                       	| //p                                                                                             	|                                                                                                        	|
|  5 	| body p                                                                   	| //body//p                                                                                       	|                                                                                                        	|
|  6 	| html > body p                                                            	| /html/body//p                                                                                   	|                                                                                                        	|
|  7 	| div > p                                                                  	| //div/p                                                                                         	|                                                                                                        	|
|  8 	|                                                                          	| //div[a]                                                                                        	| select 'a' that is a child of 'div'                                                                    	|
|  9 	| span > a.external                                                        	| //span/a[@class = "external"]                                                                   	|                                                                                                        	|
| 10 	| #special div   or <br>*#special div                                      	| //*[@id = "special"]//div                                                                       	|                                                                                                        	|
| 11 	| ol > li:nth-child(2)                                                     	| //ol/li[position() = 2]                                                                         	|                                                                                                        	|
| 12 	|                                                                          	| //ol[count(li) = 2]                                                                             	| - count()<br>- select parent that has certain number of children                                       	|
| 13 	| #cast td.role                                                            	| //*[@id = "cast"]//td[@class = "role"]                                                          	|                                                                                                        	|
