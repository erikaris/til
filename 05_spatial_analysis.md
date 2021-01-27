
## Tools:
1. R --> [ggmap](https://www.rdocumentation.org/packages/ggmap/versions/3.0.0). 
2. Python

## [ggmap](https://www.rdocumentation.org/packages/ggmap/versions/3.0.0)
Functions:
1. [get_map(location = c(lon = -95.3632715, lat = 29.7632836),
  zoom = "auto", scale = "auto")](https://www.rdocumentation.org/packages/ggmap/versions/3.0.0/topics/get_map). This returns a ggmap object. Example: <br/>
  ```
    # Get map at zoom level 5: map_5
    map5 <- get_map(location = c(lon = -123.2620, lat = 44.5646), zoom = 5, scale = 1)
  ```
  
  Output: <br />
  ```
  > map5
    640x640 terrain map image from Google Maps.  see ?ggmap to plot it.
  > str(map5)
   'ggmap' chr [1:640, 1:640] "#A9D9FE" "#A9D9FE" "#A9D9FE" "#A9D9FE" ...
   - attr(*, "source")= chr "google"
   - attr(*, "maptype")= chr "terrain"
   - attr(*, "zoom")= num 5
   - attr(*, "bb")='data.frame':	1 obs. of  4 variables:
    ..$ ll.lat: num 33.7
    ..$ ll.lon: num -137
    ..$ ur.lat: num 53.7
    ..$ ur.lon: num -109
  ```
  

2. 
