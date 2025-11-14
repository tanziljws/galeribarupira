#!/bin/bash

# 🚀 Simple Image Optimization Script
# Pakai jpegoptim & cwebp untuk optimize images

echo "🚀 Image Optimization Script"
echo "============================"
echo ""

# Check if tools installed
if ! command -v jpegoptim &> /dev/null; then
    echo "❌ jpegoptim not found!"
    echo "   Install: brew install jpegoptim"
    exit 1
fi

if ! command -v cwebp &> /dev/null; then
    echo "❌ cwebp (WebP) not found!"
    echo "   Install: brew install webp"
    exit 1
fi

# Directories
DIRS=(
    "public/uploads/photos"
    "public/uploads/fotos"
    "storage/app/public/photos"
)

TOTAL_SAVED=0
TOTAL_ORIGINAL=0
PROCESSED=0

for DIR in "${DIRS[@]}"; do
    if [ ! -d "$DIR" ]; then
        continue
    fi
    
    echo "📁 Processing: $DIR"
    
    # Process JPEG/JPG
    find "$DIR" -type f \( -iname "*.jpg" -o -iname "*.jpeg" \) | while read -r file; do
        PROCESSED=$((PROCESSED + 1))
        
        # Skip if already optimized
        if [[ "$file" == *"_optimized"* ]] || [[ "$file" == *"_thumb"* ]]; then
            continue
        fi
        
        ORIGINAL_SIZE=$(stat -f%z "$file" 2>/dev/null || stat -c%s "$file" 2>/dev/null)
        TOTAL_ORIGINAL=$((TOTAL_ORIGINAL + ORIGINAL_SIZE))
        
        echo "  🔄 Optimizing: $(basename "$file") ($(numfmt --to=iec-i --suffix=B $ORIGINAL_SIZE 2>/dev/null || echo "${ORIGINAL_SIZE} bytes"))"
        
        # Optimize JPEG (quality 85%, strip metadata)
        jpegoptim --max=85 --strip-all --preserve --force "$file" 2>/dev/null
        
        # Generate WebP
        WEBP_FILE="${file%.*}.webp"
        cwebp -q 85 "$file" -o "$WEBP_FILE" 2>/dev/null
        
        if [ -f "$WEBP_FILE" ]; then
            WEBP_SIZE=$(stat -f%z "$WEBP_FILE" 2>/dev/null || stat -c%s "$WEBP_FILE" 2>/dev/null)
            SAVINGS=$((ORIGINAL_SIZE - WEBP_SIZE))
            TOTAL_SAVED=$((TOTAL_SAVED + SAVINGS))
            
            echo "    ✅ WebP created: $(numfmt --to=iec-i --suffix=B $WEBP_SIZE 2>/dev/null || echo "${WEBP_SIZE} bytes")"
        fi
    done
    
    echo ""
done

echo "================================="
echo "📊 Summary"
echo "================================="
echo "Processed: $PROCESSED files"
echo "Total Original: $(numfmt --to=iec-i --suffix=B $TOTAL_ORIGINAL 2>/dev/null || echo "${TOTAL_ORIGINAL} bytes")"
echo "Total Saved: $(numfmt --to=iec-i --suffix=B $TOTAL_SAVED 2>/dev/null || echo "${TOTAL_SAVED} bytes")"
echo ""
echo "✅ Done!"

