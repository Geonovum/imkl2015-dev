#!/bin/bash
for URI in $(grep inspire.ec.europa waardelijsten.csv | cut -d ';' -f 7); do curl -sL -w "%{http_code} %{url_effective}\\n" "$URI" -o /dev/null; done


