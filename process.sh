for f in images/*.png; do echo "Processing $f file.."; ./wappr srcset $f; done
