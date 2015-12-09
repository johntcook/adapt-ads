# adapt-ads

This plugin was created in response to a post in a Facebook group where a user asked how to add custom personalized text on top of an image that is embedded within an email so each person who received an email would see the same image but only with their name over a specific part of the image.

Since several people within this Facebook group use WordPress for their websites, within 24 hours of seeing the post, I created this plugin to turn their WordPress website into an ad server allowing them to:
- Upload an image
- Specify where their text should be placed
- The font size of their text
- The color of their text
- Upload a font file for displaying their text

# How it works

By passing values using the url to index.php
- ?ad= {ad number}
- &message= {message text}

Different images are generated with the message text over the image in the exact coordinates specified.

This turns a WordPress install into a basic ad server.
