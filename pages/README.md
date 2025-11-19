# Lost and Found Pages - Frontend Implementation

**Created by:** Andre  
**Date:** November 13, 2025

## Overview

This folder contains the frontend pages for the Lost and Found system. Two main pages have been created with a modern blog-style card layout.

## Pages Created

### 1. `lost.html`
- Displays items that people have reported as lost
- Red accent color scheme (#e74c3c)
- Shows: date, image, title, category, description, and contact information

### 2. `found.html`
- Displays items that people have found on campus
- Green accent color scheme (#27ae60)
- Shows: date, image, title, category, description, and finder contact information

## Design Features

Both pages include:
- **Blog-style card layout** inspired by the Kicker theme
- **Date display** on the left side of each card (day + month)
- **Category tags** (Personal Items, Electronics, Documents, Clothing, etc.)
- **Responsive design** that works on mobile, tablet, and desktop
- **Sidebar** with trending/recent items
- **Hover effects** on cards for better UX
- **Contact information** for each item

## Important Notes for Team

### File Organization
✅ **Primary changes:** Only in `index.html` and `pages/` folder  
✅ **CSS approach:** Inline styles used to minimize changes to shared CSS files  
✅ **JS approach:** No new JS files created - HTML structure ready for backend integration

### For Navbar Team
- Temporary navigation links added to `index.html`
- These should be integrated into the main navbar
- Links to include:
  - Lost Items: `./pages/lost.html`
  - Found Items: `./pages/found.html`

### For Backend Team

Data structure is documented in HTML comments at the bottom of each page. Here's what the backend should provide:

#### Lost Items Data Structure
```json
{
  "id": "unique_id",
  "date": "2025-11-12",
  "category": "Personal Items | Electronics | Documents | Other",
  "title": "Item title",
  "description": "Detailed description",
  "imageUrl": "path/to/image.jpg",
  "contactName": "Full Name",
  "contactEmail": "email@student.ubt.edu",
  "contactPhone": "+383 XX XXX XXX",
  "status": "active | found | expired"
}
```

#### Found Items Data Structure
```json
{
  "id": "unique_id",
  "date": "2025-11-13",
  "category": "Personal Items | Electronics | Documents | Clothing | Other",
  "title": "Item title",
  "description": "Detailed description",
  "imageUrl": "path/to/image.jpg",
  "finderName": "Full Name",
  "finderEmail": "email@student.ubt.edu",
  "finderPhone": "+383 XX XXX XXX",
  "locationFound": "Building/Area where found",
  "status": "unclaimed | claimed | returned"
}
```

## Sample Data

Both pages currently contain mock data with placeholder images from Unsplash. The backend should replace this with:
- Real user submissions
- Uploaded images (or placeholder if no image provided)
- Real contact information (with privacy considerations)

## Future Enhancements (For Backend)

1. **Add Item Form:** Allow users to submit new lost/found items
2. **Search & Filter:** Search by keyword, filter by category/date
3. **Image Upload:** Allow users to upload images of items
4. **Status Updates:** Mark items as found/claimed/returned
5. **Notifications:** Email notifications when items match
6. **Authentication:** User accounts to manage their posts

## Testing

To view the pages:
1. Open `index.html` in a browser
2. Click on "Lost Items" or "Found Items" links
3. Pages are fully responsive - test on different screen sizes

## Questions?

Contact Andre for any questions about the frontend implementation.

