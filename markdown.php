function parse_markdown($text) {
    // 1. Basic Bold/Italic
    $text = preg_replace('/\*\*(.*?)\*\*/u', '<strong>$1</strong>', $text);
    $text = preg_replace('/\*([^\*]+)\*/u', '<em>$1</em>', $text);
    $text = preg_replace('/_([^_]+)_/u', '<em>$1</em>', $text);

    // 2. Headers
    $text = preg_replace('/^### (.*)$/m', '<h3>$1</h3>', $text);

    // 3. Handle Lists
    $text = preg_replace('/^\s*[\-\•]\s+(.*)$/m', '<li class="sub-item">$1</li>', $text);
    $text = preg_replace('/^\d+\.\s+(.*)$/m', '<li class="main-item">$1</li>', $text);

    // 4. Wrap List items in <ol>
    $text = preg_replace('/((?:<li.*?>.*?<\/li>\s*)+)/s', '<ol class="badge-list">$1</ol>', $text);

    // 5. Paragraph Handling - Split by double newlines
    $parts = explode("\n\n", $text);
    foreach ($parts as &$part) {
        $part = trim($part);
        // If it's not a block element, wrap in <p>
        if (!preg_match('/^<(h3|ol|li|ul)/', $part) && strlen($part) > 0) {
            $part = '<p>' . nl2br($part) . '</p>';
        }
    }
    $text = implode("\n", $parts);

    // 6. Cleanup extra whitespace and incorrect <br> tags
    $text = preg_replace('/>\s+<li/u', '><li', $text);
    $text = preg_replace('/<\/li>\s+<li/u', '</li><li', $text);
    $text = str_replace(["<ol class='badge-list'><br />", "</li><br />", "<ol class=\"badge-list\"><br />"], ["<ol class='badge-list'>", "</li>", "<ol class=\"badge-list\">"], $text);

    return $text;
}