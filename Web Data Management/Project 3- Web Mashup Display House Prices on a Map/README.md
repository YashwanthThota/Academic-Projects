# Web Mashup: Display House Prices on a Map Using HTML, Javascript, Ajax

**DESCRIPTION:** 
  - This application inserts an overlay marker on the Google map pinned on the latest house that displays the house's postal address and its house value.
  - The text display area is the history log that displays all the houses (addresses and prices) that you have found so far (latest house is last).
  
**FEATURES:**
  - The artist information like the artist name, Information about the artist (biography), their picture, a list of their top albums (titles & pictures), and a list of names of similar artists is displayed
  - Each time you find a house, the old marker is erased from the map (if any), display a new marker on the map on the house location (with address and price), and this information is appended to the display area
  - There are two ways to find a house:
    - By providing a valid postal address, say "904 Austin St, Arlington, TX 76012", in the text input and you push the Find button.
    - By clicking on a house on the map.

**TECHNICAL FEATURES:**
   - This application is developed using plain **Javascript, Ajax**. No javascript libraries are used.
   - Used **ZillowAPI** for getting the house price.
   - Used **Google Maps Markers** for overlay marker.
   - Used **Google maps Javascript API** for finding the house address
   - Used **Geocoding and Reverse Geocoding** for finding out a valid address
   - Used **Ajax** for requesting data and the data is returned in **XML** format .
   - This application loads data asynchronously, so the web page should never be redrawn/refreshed completely.

**DEMO LINK(HOSTED IN HEROKU):**
 (https://enigmatic-citadel-88888.herokuapp.com/)
