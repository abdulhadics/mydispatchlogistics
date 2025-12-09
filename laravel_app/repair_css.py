
import os

file_path = r'c:\xampp\htdocs\HTMLSTORE_TRUCK\laravel_app\public\assets\css\style.css'

with open(file_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

# Keep lines 0 to 424 (index 424 is line 425)
# Line 424 in 0-indexed is line 425 in 1-indexed.
# In Step 117, line 424 is "    font-weight: 600;".
# So we want lines[:424].

new_lines = lines[:424]

# Append the closing of .hero-text .badge
new_lines.append("    text-transform: uppercase;\n")
new_lines.append("    letter-spacing: 0.05em;\n")
new_lines.append("    margin-bottom: 1.5rem;\n")
new_lines.append("}\n\n")

# Append missing blocks
missing_css = """.hero-text p {
    font-size: 1.25rem;
    color: #a3a3a3;
    margin-bottom: 2rem;
    line-height: 1.7;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.hero-image {
    position: relative;
}

.hero-image img {
    width: 100%;
    height: 400px;
    object-fit: contain;
    border-radius: 16px;
    border: none;
}

/* Stats Section */
.stats {
    background: rgba(23, 23, 23, 0.5);
    padding: 4rem 0;
    border-top: 1px solid rgba(38, 38, 38, 0.8);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    text-align: center;
}

.stat-item h3 {
    font-size: 3rem;
    font-weight: 900;
    color: white;
    margin-bottom: 0.5rem;
}

.stat-item p {
    color: #a3a3a3;
    font-weight: 500;
}

/* Features Section */
.features {
    padding: 6rem 0;
    background: #0a0a0a;
}

"""
new_lines.append(missing_css)

# Process the rest of the file (lines 425 onwards)
# These are indented by 4 spaces.
for line in lines[425:]:
    if line.startswith("    "):
        new_lines.append(line[4:])
    else:
        new_lines.append(line)

with open(file_path, 'w', encoding='utf-8') as f:
    f.writelines(new_lines)

print("File repaired successfully.")
