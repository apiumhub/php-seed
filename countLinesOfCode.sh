#!/usr/bin/env bash
#for file in $(git --git-dir="$folder" ls-tree --name-only -r HEAD); do git --git-dir="$folder" show HEAD:"$file" | grep -v "^\s+'.*"; done | wc -l
for file in $(git --git-dir=".git" ls-tree --name-only -r HEAD | grep -v ".*\.md\|txt"); do git --git-dir=".git" show HEAD:"$file" | grep -v "^\s*//\|#.*"| grep -v '^[[:space:]]*$'; done | wc -l



