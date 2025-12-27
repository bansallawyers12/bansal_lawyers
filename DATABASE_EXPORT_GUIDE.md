# Database Export Guide

This guide explains how to export/download your database for the Bansal Lawyers application.

## Method 1: Using PowerShell Script (Recommended)

1. Open PowerShell in the project root directory
2. Run the script:
   ```powershell
   .\export-database.ps1
   ```
3. The script will automatically:
   - Read database credentials from your `.env` file
   - Export the database to a timestamped SQL file (e.g., `database_backup_20241215_143022.sql`)

**Note:** If you get an execution policy error, run:
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

## Method 2: Using Batch File

1. Double-click `export-database.bat` or run it from Command Prompt
2. Enter your database credentials when prompted
3. The database will be exported to a timestamped SQL file

## Method 3: Using phpMyAdmin (Easiest for XAMPP)

1. Start XAMPP and ensure MySQL is running
2. Open your browser and go to: `http://localhost/phpmyadmin`
3. Select your database from the left sidebar (usually `bansal_lawyers` or as configured in `.env`)
4. Click on the **"Export"** tab at the top
5. Choose export method:
   - **Quick**: Exports with default settings
   - **Custom**: Allows you to customize export options
6. For Custom export, recommended settings:
   - Format: **SQL**
   - Export method: **SQL**
   - Structure: ✓ Add DROP TABLE / VIEW / PROCEDURE / FUNCTION / EVENT / TRIGGER statement
   - Data: ✓ Add INSERT statement
   - Compression: **None** (or **gzip** for large databases)
7. Click **"Go"** button
8. The SQL file will be downloaded to your Downloads folder

## Method 4: Using Command Line (mysqldump)

If you have MySQL command line tools in your PATH, you can run:

```bash
mysqldump -h 127.0.0.1 -u root -p bansal_lawyers > database_backup.sql
```

Or if using XAMPP's MySQL:

```bash
C:\xampp\mysql\bin\mysqldump.exe -h 127.0.0.1 -u root -p bansal_lawyers > database_backup.sql
```

Replace:
- `root` with your database username
- `bansal_lawyers` with your actual database name
- You'll be prompted for the password

## Method 5: Using Laravel Artisan (if available)

Some Laravel packages provide database export commands. You can check if any are available:

```bash
php artisan list | grep database
```

## Finding Your Database Credentials

Your database credentials are stored in the `.env` file in the project root:
- `DB_HOST` - Database host (usually `127.0.0.1` or `localhost`)
- `DB_PORT` - Database port (usually `3306`)
- `DB_DATABASE` - Database name
- `DB_USERNAME` - Database username
- `DB_PASSWORD` - Database password

## Importing the Database Later

To import the exported database later, you can:

1. **Using phpMyAdmin:**
   - Go to phpMyAdmin
   - Select your database
   - Click "Import" tab
   - Choose the SQL file and click "Go"

2. **Using Command Line:**
   ```bash
   mysql -h 127.0.0.1 -u root -p bansal_lawyers < database_backup.sql
   ```

## File Locations

- Exported files will be saved in the project root directory
- Files are named with timestamp: `database_backup_YYYYMMDD_HHMMSS.sql`
- Make sure to backup these files in a safe location

## Troubleshooting

### "Access denied" error
- Check your database username and password in `.env`
- Make sure MySQL is running in XAMPP

### "Database not found" error
- Verify the database name in `.env` matches your actual database
- Create the database first if it doesn't exist

### "mysqldump not found" error
- Update the XAMPP path in the script to match your installation
- Or use phpMyAdmin method instead


