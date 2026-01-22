# Database Setup for Painter Project

## Files:
- `structure.sql` - Database tables structure only
- `sample_data.sql` - Demo data for testing Redis caching

## Quick Setup:

### Option 1: Import everything at once:
```bash
mysql -u root -p < database/structure.sql
mysql -u root -p painter < database/sample_data.sql