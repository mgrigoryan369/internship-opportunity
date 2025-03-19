# WP CLI Commands, Might Come in Handy

## 🏗️ WP Core Commands

- `wp core version` → Check current WordPress version
- `wp core check-update` → See if updates are available
- `wp core update` → Update WordPress core
- `wp core update-db` → Update the database structure

---

## 🎨 WP Theme Commands

- `wp theme status` → Check active theme
- `wp theme list` → List all installed themes
- `wp theme get [slug]` → Get full theme details (including paths)
- `wp theme delete [slug]` → Delete a theme
- `wp theme install [slug|zip-path|URL]` → Install a theme
- `wp theme activate [slug]` → Activate a theme
- `wp theme update [slug]` → Update a specific theme
- `wp theme update --all` → Update all themes

---

## 🔌 WP Plugin Commands _(Similar to Theme Commands)_

- `wp plugin status` → Check active plugins
- `wp plugin list` → List all installed plugins
- `wp plugin get [slug]` → Get detailed plugin info
- `wp plugin toggle [slug]` → Activate/deactivate a plugin
- `wp plugin install [slug]` → Install a plugin
- `wp plugin uninstall [slug]` → Remove a plugin + data
- `wp plugin delete [slug]` → Delete a plugin but keep data
- `wp plugin activate [slug]` → Activate a plugin
- `wp plugin deactivate --all` → Deactivate all plugins _(Great for troubleshooting!)_

---

## 📝 WP Post Manipulation

- `wp post-type list` → List all post types
- `wp post-type get [slug]` → Get details of a post type
- `wp post list` → List all posts
- `wp post list --posts_per_page=10` → Show 10 most recent posts
- `wp post list --post_type=page` → List specific post types
- `wp post create --post_title="Why CLI is Amazing"` → Create a post
- `wp post generate --count=10` → Generate 10 blank posts
- `wp post delete 36 37 38` → Delete posts by ID

The CLI documentation API link for fetching wasn't working, used this one, just for demo, Generate 30 Posts with content pulled from API

- `curl -N https://power-plugins.com/api/flipsum/ipsum/lorem-ipsum?paragraphs=5 | wp post generate --post_content --count=30` → Generate 30 posts with content from an API

- `wp post list --tag=wp-cli` → list posts with the tag (note: --tag vs --post_tag, by design WP Query)
- `wp post term add [ID] category wpcli` → add ID taxonomy slug

---

## 💬 WP Comment Commands

- `wp comment list --number=25` → Show 25 most recent comments
- `wp comment list --status=hold` → List unapproved comments
- `wp comment list --status=hold --fields=comment_ID,comment_content` → View pending comments
- `wp comment spam $(wp comment list --status=hold --format=ids)` → Mark pending comments as spam
- `wp comment approve $(wp comment list --status=hold --format=ids)` → Approve all pending comments
- `wp comment count` → Get total comment count
- `wp comment list --status=spam --fields=comment_ID,comment_content` → View spam comments
- `wp comment delete $(wp comment list --status=spam --format=ids) --force` → Skip trash & permanently delete spam comments

## 🏷️ WP Terms & Taxonomies

- `wp taxonomy list` → List all registered taxonomies
- `wp taxonomy list --public=1` → List only public taxonomies
- `wp term list category` → Show all categories
- `wp term create post_tag [slug]` → Create a new tag
- `wp term update post_tag [ID] --name="WP-CLI"` → Rename an existing tag
- `wp term list post_tag` → List all tags
- `wp term migrate [ID] --from=post_tag --to=category` → Convert a tag into a category

## 🖼️ WP Media Commands

- `wp media image-size` → Show all registered image sizes
- `wp media regenerate --only-missing --yes` → Regenerate only missing thumbnails
- `wp media import [path-to-file] --post_id=[ID] --featured_image` → Upload an image & set as featured
- `wp media import [path]` → Bulk upload images using wildcard (e.g., `*.jpg`)

## 👥 WP User & Role Management

### 🔹 Role Management

- `wp role list` → List all roles.
- `wp role create [role_slug] [Role Title] --clone=editor` → Create a new role by cloning the editor role.
- `wp role reset [role]` → Reset role capabilities to default.
- `wp cap list [role]` → List capabilities of a specific role.
- `wp cap list [role] | sort` → Sort capabilities alphabetically.
- `wp cap add [role_slug] [space-separated capabilities]` → Add custom capabilities to a role.
- `wp cap remove [role_slug] [space-separated capabilities]` → Remove specific capabilities from a role.

---

### 🔹 User Management

- `wp user create [username] [email] --role=[role_slug]` → Create a user with a specific role.
- `wp user get [username]` → Show details of a specific user.
- `wp user list` → Display all users.
- `wp user delete [ID]` → Delete a user by ID.
- `wp user reset-password [username]` → Reset a user's password so they can set a new one.
- `wp user list-caps [username] | sort` → List and sort user capabilities.
- `wp user generate --count=5 --role=bronze | wp user generate --count=5 --role=silver | wp user generate --count=5 --role=gold` → Generate multiple users with different roles.

---

### 🔹 User Meta (Custom Fields)

- `wp user meta list [username]` → Show all user meta fields.
- `wp user meta update [username] first_name [desired_name]` → Update the user's first name.
- `wp user meta update [username] last_name [desired_last_name]` → Update the user's last name.
- `wp user meta update [username] description [desired_description]` → Update the user bio/description.
- `wp user meta update [username] articles_proofed 47` → Add a custom meta field (`articles_proofed`) with a value of `47`.
- `wp user meta delete [username] first_name` → Delete a user's first name meta.

---

### 🔹 Importing & Exporting Users

- `wp user import-csv [path to file]` → Import users from a CSV file.

---

## 🛠️ WP Options Table

- `wp option list` → Show all options in the options table.
- `wp option get [option_name]` → Retrieve the value of an option _(e.g., `wp option get siteurl`)_.
- `wp option update [option_name] [value]` → Update an option _(e.g., `wp option update posts_per_rss 300`)_.
- `wp option list --search="[*name*]"` → Search for an option using a wildcard _(e.g., `wp option list --search="home%"`)_.
- `wp option add [option_name] [value]` → Add a custom option to the options table.
- `wp option delete [option_name]` → Remove an option from the options table.
- `wp option pluck [option_name] [key]` → Extract a specific value from a serialized option _(e.g., `wp option pluck my_serialized_option sub_key`)_.
- `wp option patch [insert|update|delete] [option_name] [key-path] [value]` → Modify nested data within serialized options.

---

## ⚙️ WP Maintenance & Troubleshooting & Query

- `wp cache flush` → flushes cache
- `wp transient [delete|get|list|set|type]` → temporary cached data, time-sensitive (like cookies)
- `wp transient list` → generates the list of current transients
- `wp transient delete --all` → delete all transients from DB
- `wp rewrite list` → list all rewrite rules that have been added
- `wp rewrite flush` → forces WordPress to flush rewrite rules
- `wp embed fetch [url]` → force oEmbed fetch, store in cache, replace when found
- `wp embed cache clear [id]` → clear specific post (ID) cache
- `wp db size` → get the database size
- `wp db prefix` → check the current database prefix
- `wp db tables` → get a list of tables or use `--all-tables` to list ALL tables
- `wp db columns [table]` → get a list of columns in a specific table
- `wp db query "SELECT ID, post_title FROM wp_posts WHERE post_type='post' ORDER BY ID DESC LIMIT 20"` → fetch recent posts with ID and title
- `wp db query "SELECT ID, post_title, meta_key, meta_value FROM wp_posts INNER JOIN wp_postmeta ON ID = post_id WHERE post_type='post' ORDER BY ID DESC LIMIT 20"` → get posts with their meta info
- `wp db query "SELECT wp_comments.comment_ID, comment_approved, meta_key, meta_value FROM wp_comments INNER JOIN wp_commentmeta ON wp_comments.comment_ID = wp_commentmeta.comment_ID WHERE comment_approved='spam' LIMIT 10"` → get a list of spam comments
- `wp db query "DELETE wp_comments, wp_commentmeta FROM wp_comments INNER JOIN wp_commentmeta ON wp_comments.comment_ID = wp_commentmeta.comment_ID WHERE comment_approved='spam'"` → delete spam comments with a database query
- `wp db search 'WP CLI' --all-tables` → search for "WP CLI" across all tables
- `wp db optimize` → reorganize and improve I/O
- `wp db repair` → attempt to repair possibly corrupt tables
- `wp db clean` → drop all tables with the current prefix _(Multisite only)_
- `wp db config set table_prefix [prefix_]` → set a new prefix, then run `wp core install`
- `wp db reset` → drop the entire database and recreate it fresh
- `wp db export [db_file_name.sql]` → export the database
- `scp [db_file_name.sql] [path]` → upload/download the file to a remote location
- `scp [path_name][db_file_name.sql] ./` → upload the database file
- `wp db import [db_file_name.sql]` → import the database
- `wp search-replace [old_string] [new_string]` → find and replace URLs or text in the database
- `wp option get siteurl` → check if the site URL change worked _(may also need to fix prefixes with `clean` and `config set`)_
