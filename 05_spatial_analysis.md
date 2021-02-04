
## Tools:
1. R, some of available packages are:

  1. [ggmap](https://www.rdocumentation.org/packages/ggmap/versions/3.0.0). 
  2. [sp](https://www.rdocumentation.org/packages/sp/versions/1.4-5) --> classes and Mmthods for spatial data. Provides classes for storing di(erent types of spatial data. 
  3. [tmap](https://www.rdocumentation.org/packages/tmap/versions/3.2/topics/tmap-package) --> Thematic Map Visualization. 
  
2. Python

## [ggmap](https://www.rdocumentation.org/packages/ggmap/versions/3.0.0)
Functions:
1. [get_map(location = c(lon = -95.3632715, lat = 29.7632836, maptype = c("terrain", "terrain-background", "satellite", "roadmap", "hybrid", "toner", "watercolor", "terrain-labels", "terrain-lines", "toner-2010", "toner-2011", "toner-background", "toner-hybrid", "toner-labels", "toner-lines", "toner-lite"), source = c("google", "osm", "stamen")), zoom = "auto", scale = "auto")](https://www.rdocumentation.org/packages/ggmap/versions/3.0.0/topics/get_map). This returns a ggmap object. Example: <br/>
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

##  sp

1. The sp classes are `S4` objects, so instead of having elements they have `slots` and we have to access them with `@`.
2. 2 types of `sp` objects:
    1. SpatialPolygons (sp) --> It is an object consists of 4 slots: `polygons`, `plotOrder`, `bbox`, `proj4string`. Example: <br />
        ```
        > str(countries_sp, max.level=2)
        Formal class 'SpatialPolygons' [package "sp"] with 4 slots
          ..@ polygons   :List of 177
          ..@ plotOrder  : int [1:177] 7 136 28 169 31 23 9 66 84 5 ...
          ..@ bbox       : num [1:2, 1:2] -180 -90 180 83.6
          .. ..- attr(*, "dimnames")=List of 2
          ..@ proj4string:Formal class 'CRS' [package "sp"] with 1 slot
        ```
        
        ```
        summary(countries_sp)
        Object of class SpatialPolygons
        Coordinates:
                min       max
        x -180.0000 180.00000
        y  -89.9999  83.64513
        Is projected: FALSE 
        proj4string :
        [+proj=longlat +datum=WGS84 +no_defs +ellps=WGS84 +towgs84=0,0,0]
        ```
    
    2. SpatialPolygonsDataFrame --> Similar to the `sp` object but has additional `data` slot. <br />
        
        ![Alt text](./images/spdf_hiearchy.png)
    
        Example: <br />
        ```
        > str(countries_spdf, max.level=2)
        Formal class 'SpatialPolygonsDataFrame' [package "sp"] with 5 slots
          ..@ data       :'data.frame':	177 obs. of  6 variables:
          ..@ polygons   :List of 177
          ..@ plotOrder  : int [1:177] 7 136 28 169 31 23 9 66 84 5 ...
          ..@ bbox       : num [1:2, 1:2] -180 -90 180 83.6
          .. ..- attr(*, "dimnames")=List of 2
          ..@ proj4string:Formal class 'CRS' [package "sp"] with 1 slot
        ```
        ```
        summary(countries_spdf)
        Object of class SpatialPolygonsDataFrame
        Coordinates:
                min       max
        x -180.0000 180.00000
        y  -89.9999  83.64513
        Is projected: FALSE 
        proj4string :
        [+proj=longlat +datum=WGS84 +no_defs +ellps=WGS84 +towgs84=0,0,0]
        Data attributes:
             name              iso_a3            population             gdp          
         Length:177         Length:177         Min.   :1.400e+02   Min.   :      16  
         Class :character   Class :character   1st Qu.:3.481e+06   1st Qu.:   13198  
         Mode  :character   Mode  :character   Median :9.048e+06   Median :   43450  
                                               Mean   :3.849e+07   Mean   :  395513  
                                               3rd Qu.:2.616e+07   3rd Qu.:  235100  
                                               Max.   :1.339e+09   Max.   :15094000  
                                               NA's   :1           NA's   :1         
            region           subregion        
         Length:177         Length:177        
         Class :character   Class :character  
         Mode  :character   Mode  :character 
        ```

## tmap

`tmap` provides two ways of creating thematic maps: (1) quick method and (2) main plotting method. 

### Quick Method 

1. [`qtm(shp)`](https://www.rdocumentation.org/packages/tmap/versions/3.2/topics/qtm) --> for quick thematic maps.

### Main Plotting Method

Works like `ggplot` with a base layer `tm_shape()` and several additional layers:

1. aesthetic base layers:
    1. [`tm_fill(col, style)`](https://www.rdocumentation.org/link/tm_fill?package=tmap&version=3.2) --> Create a polygon layer (without borders). 
    2. [`tm_borders(col)`] --> Create polygon borders. 
    3. [`tm_bubbles(size)`] --> create a layer of bubbles. 
2. aesthetic derived layers
3. faceting layers

