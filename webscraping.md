# Web Scraping

## Tools

1. R --> rvest, rselenium
2. python --> scrapy, beautiful soup. 

## Steps:
1. there is an HTML file --> `mythml`. 
2. extract the node
    ```
    myhtml %>%
      html_nodes()
    ```

## Extracting function
1. html_node()
2. html_nodes(args)  --> args = css selectors or xpath. 
  a. using css selector: `html_nodes('div p')`.
  b. using xpath: `html_nodes(xpath = '//div//p')`.
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

Select intended node using css selectors or xpath wrapped as argument(s) in method `html_nodes()`. 

### css selectors

1. Selecting nodes or component using either:
    1. type (e.g.: `p`, `h2`)
    2. class (`.`)
    3. id (`#`)
    4. or combination of the four things above. 
2. Using selectors:
    1. selecting 1 type --> `html %>% html_nodes('type')`.
    2. selecting > 1 types, seperate them by comma (`,`) --> `html %>% html_nodes('type1, type2')`.
    3. all, use `*` --> `html %>% html_nodes('*')`.
    4. select by class (`.`) --> `html %>% html_nodes('.alert')`.
    5. select by > 1 class (`.class1.class2`) --> `html %>% html_nodes('.alert.emph')`.
    6. select by id (`#`) --> `html %>% html_nodes('#special')`.
    7. select by type and class (`type.class`) --> `html %>% html_nodes('a.alert')`.
    8. select by type and id (`type#id`) --> `html %>% html_nodes('div#special')`.
    9. select by element's position (`pseudo-class`):
        1. first (`:first-child`) --> `html %>% html_nodes('li:last-child')`.
        2. last (`:last-child`) --> `html %>% html_nodes('p:last-child')`.
        3. nth (`:nth-child(n)`) --> `html %>% html_nodes('h3:nth-child(5)`.
3. Family combinators:
    1. Structure: `h2#someid {space|>|+|~} .someclass`.
        1. `space`: descendant combinator --> example: `html %>% html_nodes('div.first a')` --> get all `a`s that are the descendant of `div.first`. 
        2. `>` : child combinator --> example: 
        3. `+` : adjacent sibling combinator.
        4.  `~` : general sibling combinator. 

### xpath

1. start with double slash `//`. Next element use single slash `/`. 
2. specify class, id, css, position, count, etc using **predicate** `[...]`. 


### css selectors vs xpath

| No 	| css selectors 	| xpath 	| explanation 	|
|-	|-	|-	|-	|
| 1 	| div > p.blue 	| //div/p[@class = "blue"] 	| - [..] = predicate<br>- @ for class 	|
| 2 	| ul.list > li:nth-child(5), ul.list > li:last-child, ul.list > li.special 	| //ul[@class = "list"]/li[position() > 4 or @class = "special"] 	| position() =, < , <=, >, >=, !=<br><br>--> for selecting the nth element<br>--> position starts from 1 	|
| 3 	|  	| - //ol/li[position() != 3 and @class = "blue"]<br>- //ol/li[position() != 3 or @class = "blue"] 	| combining xpath: 'and', 'or' 	|
| 4 	|  p 	| //p 	|  	|
| 5 	| body p 	| //body//p 	|  	|
| 6 	| html > body p 	| /html/body//p 	|  	|
| 7 	| div > p 	| //div/p 	|  	|
| 8 	|  	| //div[a] 	| select 'a' that is a child of 'div' 	|
| 9 	| span > a.external 	| //span/a[@class = "external"] 	|  	|
| 10 	| #special div   or <br>*#special div 	| //*[@id = "special"]//div 	|  	|
| 11 	| ol > li:nth-child(2) 	| //ol/li[position() = 2] 	|  	|
| 12 	|  	| //ol[count(li) = 2] 	| - count()<br>- select parent that has certain number of children 	|
| 13 	| #cast td.role 	| //*[@id = "cast"]//td[@class = "role"] 	|  	|
| 14 	| table td.role > text() 	| //table//td[@class = "role"]/text() 	| apa text() di css selectors? 	|
| 15 	| #cast td.role 	| //*[@id = "cast"]//td[@class = "role" and text() = " (Voice)"] 	| apa 'and' di css selectors? 	|
| 16 	|  	| ..<br>--> html_nodes(xpath = '..') 	| selects the parent of each selected element 	|
