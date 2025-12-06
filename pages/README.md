# Lost and Found System - Frontend Documentation

**Created by:** Andre  
**Date:** November 2025  
**Last Updated:** November 2025

## 📁 Project Structure

```
Lost_And_Found/
├── index.html                 # Home page
├── pages/
│   ├── lost.html             # Lost items listing page
│   ├── found.html            # Found items listing page
│   ├── detail.html           # Item detail page
│   └── README.md             # This file
├── css/
│   └── index.css             # Shared CSS (minimal changes needed)
├── js/
│   └── index.js              # Shared JavaScript (currently minimal)
├── media/
│   ├── background.png        # Background image for pages
│   └── favicon.ico           # Site favicon
└── Ubtlogo.png              # UBT logo (used in navbar)
```

---

## 📄 Pages Overview

### 1. **index.html** (Home Page)
- **Location:** `/Lost_And_Found/index.html`
- **Purpose:** Landing page with navigation links
- **Current State:** Simple welcome page with links to lost/found pages
- **For Backend Team:** Replace static links with dynamic navigation if needed

### 2. **lost.html** (Lost Items Page)
- **Location:** `/Lost_And_Found/pages/lost.html`
- **Purpose:** Displays all lost items in card format
- **Features:**
  - Item cards with images, titles, descriptions
  - Pagination (bottom of page)
  - Navbar with scroll shrink effect
  - Footer with scroll behavior
  - "View Details" links to detail page

### 3. **found.html** (Found Items Page)
- **Location:** `/Lost_And_Found/pages/found.html`
- **Purpose:** Displays all found items in card format
- **Features:** Same as lost.html but for found items
- **Note:** Structure identical to lost.html, only content differs

### 4. **detail.html** (Item Detail Page)
- **Location:** `/Lost_And_Found/pages/detail.html`
- **Purpose:** Shows detailed information about a specific item
- **URL Parameters:** `?type=lost&id=1` or `?type=found&id=1`
- **Features:**
  - Large item image
  - Full description
  - Date and location information
  - Contact information
  - Back button to return to listing page

---

## 🔍 Code Locations

### **Navbar Implementation**

**Location:** All pages (`lost.html`, `found.html`, `detail.html`)

**HTML Structure:**
- Lines ~750-765: Navbar HTML
- Contains: UBT logo, navigation links (Home, Lost Items, Found Items, Report Item button)

**CSS:**
- Lines ~33-200: Navbar styling
- Key classes:
  - `.site-navbar` - Main navbar container
  - `.site-navbar.scrolled` - Shrunk state when scrolling
  - `.navbar-logo` - Logo container
  - `.navbar-links` - Navigation links container
  - `.navbar-links a.active` - Active page indicator
  - `.report-item-btn` - Special styling for "Report Item" button

**JavaScript:**
- Lines ~1036-1043: Navbar scroll shrink effect
- Lines ~1065-1091 (lost.html/found.html) or similar in detail.html: Active page detection

**For Login Team:**
- Add login/logout button in `.navbar-links` (after "Report Item" or replace it when logged in)
- Add user profile dropdown if needed
- Active state detection logic is at lines ~1065-1091 - extend this for login state

---

### **Item Cards Structure**

**Location:** `lost.html` and `found.html`

**HTML Structure:**
- Lines ~730-850: Item card template
- Each card is an `<article class="item-card">`
- Structure:
  ```html
  <article class="item-card">
    <div class="date-section"></div>  <!-- Date display (currently empty, backend should populate) -->
    <div class="item-content">
      <img class="item-image" src="..." />
      <div class="item-details">
        <p class="item-title">Title</p>
        <p class="item-description">Description</p>
        <div class="item-contact">
          <div class="contact-label">Contact</div>
          <div class="contact-info">email • phone</div>
          <a href="detail.html?type=lost&id=1" class="read-more">View Details</a>
        </div>
      </div>
    </div>
  </article>
  ```

**CSS:**
- Lines ~241-400: Item card styling
- Key classes:
  - `.item-card` - Main card container
  - `.item-image` - Item image
  - `.item-title` - Item title
  - `.item-description` - Item description
  - `.item-contact` - Contact information section
  - `.read-more` - "View Details" link

**For Backend Team:**
- Replace static cards (lines ~730-850) with dynamic generation
- Use template above to generate cards from API data
- Update "View Details" links: `detail.html?type=lost&id={itemId}` or `detail.html?type=found&id={itemId}`

---

### **Pagination**

**Location:** `lost.html` and `found.html`

**HTML Structure:**
- Lines ~979-987: Pagination HTML
- Structure:
  ```html
  <div style="display: flex; justify-content: center;">
    <div class="pagination">
      <a href="lost.html?page=1" class="active">1</a>
      <a href="lost.html?page=2">2</a>
      <a href="lost.html?page=3">3</a>
      <a href="lost.html?page=4">4</a>
    </div>
  </div>
  ```

**CSS:**
- Lines ~509-568: Pagination styling
- Key classes:
  - `.pagination` - Pagination container
  - `.pagination a` - Page number links
  - `.pagination .active` - Active page indicator

**JavaScript:**
- Lines ~971-981: Pagination active state detection
- Reads URL parameter: `?page=1`, `?page=2`, etc.

**For Backend Team:**
- Replace static page numbers with dynamic generation based on total pages
- API should return: `{ items: [...], totalPages: 10, currentPage: 1 }`
- Generate pagination links dynamically based on `totalPages`

---

### **Detail Page**

**Location:** `detail.html`

**HTML Structure:**
- Lines ~580-620: Detail page content
- Structure:
  ```html
  <div class="detail-card">
    <div class="detail-image-container">
      <img id="detailImage" class="detail-image" />
    </div>
    <div class="detail-content">
      <h1 id="detailTitle">Title</h1>
      <p id="detailDescription">Description</p>
      <div class="detail-info-grid">
        <div class="detail-info-item">
          <div class="detail-info-label">Date</div>
          <div id="detailDate">Date</div>
        </div>
        <div class="detail-info-item">
          <div class="detail-info-label">Location</div>
          <div id="detailLocation">Location</div>
        </div>
      </div>
      <div class="detail-contact">
        <div id="contactLabel">Contact</div>
        <div id="detailContact">Contact info</div>
      </div>
    </div>
  </div>
  ```

**JavaScript:**
- Lines ~656-774: Item data loading
- Lines ~740-774: `loadItem()` function that reads URL params and populates page
- Current implementation uses static `items` object (lines ~660-738)
- **IMPORTANT:** Replace this with API call

**For Backend Team:**
- Replace `items` object (lines ~660-738) with API call
- Function `loadItem()` should fetch: `/api/items/{type}/{id}`
- URL parameters: `?type=lost&id=1` or `?type=found&id=1`

---

### **Footer**

**Location:** All pages

**HTML Structure:**
- Lines ~890-950: Footer HTML
- Contains: Site links, copyright, social media, contact info

**CSS:**
- Lines ~570-747: Footer styling
- Key classes:
  - `.site-footer` - Main footer container
  - `.site-footer.visible` - Footer visibility state
  - `.site-footer.footer-scrolled` - Shrunk state

**JavaScript:**
- Lines ~1045-1059: Footer scroll behavior (show/hide, shrink/enlarge)

---

## 🔌 Backend Integration Points

### **1. Lost Items API**

**Endpoint Needed:** `GET /api/lost-items?page=1&limit=4`

**Response Format:**
```json
{
  "items": [
    {
      "id": 1,
      "title": "Lost Wallet",
      "description": "Black leather wallet with cards",
      "imageUrl": "/uploads/item1.jpg",
      "date": "2025-11-12",
      "location": "Building A, Room 101",
      "contactEmail": "user@student.ubt.edu",
      "contactPhone": "+383 XX XXX XXX",
      "status": "active"
    }
  ],
  "totalPages": 10,
  "currentPage": 1,
  "totalItems": 40
}
```

**Integration Location:**
- File: `lost.html`
- Replace: Lines ~730-850 (static item cards)
- Add: JavaScript function to fetch and render items
- Update: Pagination (lines ~979-987) to use `totalPages` from API

---

### **2. Found Items API**

**Endpoint Needed:** `GET /api/found-items?page=1&limit=4`

**Response Format:** Same as lost items, but with:
```json
{
  "items": [
    {
      "id": 1,
      "title": "Found Phone",
      "description": "iPhone found in library",
      "imageUrl": "/uploads/item1.jpg",
      "date": "2025-11-13",
      "location": "Building B, Room 205",
      "contactEmail": "finder@student.ubt.edu",
      "contactPhone": "+383 XX XXX XXX",
      "status": "unclaimed"
    }
  ],
  "totalPages": 10,
  "currentPage": 1,
  "totalItems": 40
}
```

**Integration Location:**
- File: `found.html`
- Same structure as `lost.html`

---

### **3. Item Detail API**

**Endpoint Needed:** `GET /api/items/{type}/{id}`

**Response Format:**
```json
{
  "id": 1,
  "type": "lost",
  "title": "Lost Wallet",
  "description": "Full description here...",
  "imageUrl": "/uploads/item1.jpg",
  "date": "2025-11-12",
  "location": "Building A, Room 101",
  "contactEmail": "user@student.ubt.edu",
  "contactPhone": "+383 XX XXX XXX",
  "contactLabel": "Contact" // or "Contact to Claim" for found items
}
```

**Integration Location:**
- File: `detail.html`
- Replace: `items` object (lines ~660-738)
- Update: `loadItem()` function (lines ~740-774) to fetch from API instead of static object

---

### **4. Pagination Integration**

**Current Implementation:**
- Reads URL parameter: `?page=1`
- JavaScript: Lines ~971-981 in `lost.html` and `found.html`

**Backend Should:**
- Accept `page` parameter in API calls
- Return `totalPages` in response
- Frontend generates pagination links dynamically

**Code to Update:**
```javascript
// Current (static):
<a href="lost.html?page=1" class="active">1</a>
<a href="lost.html?page=2">2</a>

// Should become (dynamic):
// Generate based on totalPages from API response
```

---

## 🔐 Login/Authentication Integration Points

### **1. Navbar Login Button**

**Location:** All pages, navbar section (lines ~750-765)

**Current State:**
- "Report Item" button exists (line ~763)
- No login/logout functionality

**Integration:**
1. Add login button when user is not authenticated
2. Replace "Report Item" with user menu when logged in
3. Add logout functionality

**Suggested HTML:**
```html
<!-- When not logged in -->
<li><a href="login.html" class="login-btn">Login</a></li>
<li><a href="#" class="report-item-btn">Report Item</a></li>

<!-- When logged in -->
<li><a href="report.html" class="report-item-btn">Report Item</a></li>
<li class="user-menu">
  <a href="profile.html">Profile</a>
  <a href="#" onclick="logout()">Logout</a>
</li>
```

**JavaScript Location:**
- Add authentication check in `DOMContentLoaded` (lines ~1062+)
- Check for auth token/session
- Update navbar accordingly

---

### **2. Protected Routes**

**Pages That May Need Authentication:**
- Report Item page (not yet created)
- User profile page (not yet created)
- Admin pages (if needed)

**Implementation:**
- Add authentication check at top of page JavaScript
- Redirect to login if not authenticated
- Example:
```javascript
document.addEventListener('DOMContentLoaded', function() {
  if (!isAuthenticated()) {
    window.location.href = 'login.html';
    return;
  }
  // Rest of page code
});
```

---

### **3. User-Specific Data**

**For "My Items" Feature:**
- Add endpoint: `GET /api/user/items`
- Filter items by logged-in user
- Add "My Lost Items" / "My Found Items" links in navbar

---

## 📝 Data Structures

### **Lost Item Object**
```javascript
{
  id: Number,
  title: String,
  description: String,
  imageUrl: String,
  date: String, // Format: "12 NOV 2025" or ISO date
  location: String, // Where item was lost
  contactEmail: String,
  contactPhone: String,
  status: String // "active" | "found" | "expired"
}
```

### **Found Item Object**
```javascript
{
  id: Number,
  title: String,
  description: String,
  imageUrl: String,
  date: String,
  location: String, // Where item was found
  contactEmail: String,
  contactPhone: String,
  status: String // "unclaimed" | "claimed" | "returned"
}
```

---

## 🎨 CSS & Styling Notes

### **Color Scheme**
- Primary Blue: `#244082`
- Accent Blue: `#8ca9ff`
- Text: `rgba(26, 26, 26, 0.8)`
- Background: Glassmorphism effect `rgba(255, 255, 255, 0.5)`

### **CSS Location**
- All styles are **inline** in each HTML file (`<style>` tag)
- Shared CSS file: `/css/index.css` (minimal, mostly for base styles)
- **No external CSS files** - all page-specific styles are inline

### **Responsive Breakpoints**
- Mobile: `@media (max-width: 768px)`
- Tablet: `@media (max-width: 1200px)`
- Desktop: Default (1400px max-width container)

---

## 🚀 JavaScript Functionality

### **Current JavaScript Features**

1. **Navbar Scroll Shrink** (all pages)
   - Location: Lines ~1036-1043
   - Adds `.scrolled` class when `scrollY > 50`

2. **Footer Scroll Behavior** (all pages)
   - Location: Lines ~1045-1059
   - Shows/hides footer based on scroll position
   - Shrinks/enlarges based on distance from bottom

3. **Active Page Detection** (all pages)
   - Location: Lines ~1065-1091
   - Highlights current page in navbar and footer

4. **Pagination Active State** (lost.html, found.html)
   - Location: Lines ~971-981
   - Reads `?page=X` from URL and highlights active page

5. **Detail Page Item Loading** (detail.html)
   - Location: Lines ~740-774
   - Reads `?type=lost&id=1` from URL
   - **TODO:** Replace static data with API call

---

## 🔧 Integration Checklist

### **For Backend Team:**

- [ ] Create API endpoints for lost items (`GET /api/lost-items`)
- [ ] Create API endpoints for found items (`GET /api/found-items`)
- [ ] Create API endpoint for item details (`GET /api/items/{type}/{id}`)
- [ ] Implement pagination in API responses
- [ ] Add image upload endpoint for item images
- [ ] Replace static item cards in `lost.html` (lines ~730-850)
- [ ] Replace static item cards in `found.html` (lines ~730-850)
- [ ] Replace static `items` object in `detail.html` (lines ~660-738) with API call
- [ ] Update pagination to be dynamic based on API `totalPages`

### **For Login/Auth Team:**

- [ ] Create login page (`login.html`)
- [ ] Create registration page (`register.html` - if needed)
- [ ] Add login/logout buttons to navbar (all pages, lines ~750-765)
- [ ] Implement authentication check in JavaScript
- [ ] Add protected routes for "Report Item" page
- [ ] Add user profile page (if needed)
- [ ] Implement session/token management
- [ ] Add "My Items" feature (user-specific items)

### **For Frontend Team (Additional Features):**

- [ ] Create "Report Item" page (`report.html` or `report-item.html`)
- [ ] Add search functionality to lost.html and found.html
- [ ] Add filter by category (if categories are implemented)
- [ ] Add image upload form in report page
- [ ] Implement form validation
- [ ] Add success/error message displays

---

## 📍 Important File Paths

### **Images & Assets**
- Logo: `/Ubtlogo.png` (used in navbar, path: `../../Ubtlogo.png` from pages folder)
- Background: `/media/background.png` (used in all pages)
- Favicon: `/media/favicon.ico`

### **Navigation Links**
- Home: `../index.html` (from pages folder)
- Lost Items: `lost.html` (from pages folder) or `./pages/lost.html` (from root)
- Found Items: `found.html` (from pages folder) or `./pages/found.html` (from root)
- Detail Page: `detail.html?type=lost&id=1` (from pages folder)

---

## 🐛 Common Issues & Solutions

### **Issue: Images not loading**
- Check image paths - they use relative paths from pages folder
- Backend should serve images from `/uploads/` or similar

### **Issue: Pagination not working**
- Check URL parameters are being read correctly
- Ensure backend returns `totalPages` in response
- Verify pagination links are generated dynamically

### **Issue: Detail page shows "Item not found"**
- Check URL parameters: `?type=lost&id=1` format
- Verify API endpoint returns data for that ID
- Check `loadItem()` function is calling correct API endpoint

---

## 📞 Contact

For questions about frontend implementation, contact Andre.

---

## 📅 Changelog

- **November 2025:** Initial frontend implementation
  - Created lost.html, found.html, detail.html
  - Implemented navbar, footer, pagination
  - Added responsive design
  - Removed unused sidebar code
  - Cleaned up unused CSS classes
