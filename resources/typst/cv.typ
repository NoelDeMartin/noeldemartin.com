#let cv = json("../../content/json/cv.json")

#set page(
  paper: "a4",
  margin: (x: 2cm, top: 1.4cm, bottom: 1.4cm),
)

#set text(
  font: ("Ubuntu"),
  size: 10pt,
  fill: rgb("#4a4a4a"),
)

#set par(justify: false, leading: 0.55em)

// Theme Colors (matching website Tailwind palette)
#let color-blue-darkest = rgb("#12283a")
#let color-blue-darker = rgb("#266193")
#let color-black = rgb("#22292f")
#let color-black-light = rgb("#4a4a4a")
#let color-grey-darkest = rgb("#3d4852")
#let color-grey-darker = rgb("#606f7b")
#let color-grey-dark = rgb("#8795a1")
#let color-grey-light = rgb("#dae1e7")

// Links
#show link: set text(fill: color-blue-darkest)
#show link: underline

// SVG Icons (matching resources/views/icons/)
#let location-icon(color: "#606f7b", size: 8.5pt) = {
  let svg = "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"" + color + "\"><path d=\"M12 21.325q-.35 0-.7-.125t-.625-.375Q9.05 19.325 7.8 17.9t-2.087-2.762t-1.275-2.575T4 10.2q0-3.75 2.413-5.975T12 2t5.588 2.225T20 10.2q0 1.125-.437 2.363t-1.275 2.575T16.2 17.9t-2.875 2.925q-.275.25-.625.375t-.7.125M12 12q.825 0 1.413-.587T14 10t-.587-1.412T12 8t-1.412.588T10 10t.588 1.413T12 12\"/></svg>"
  box(baseline: 12%, image(bytes(svg), width: size))
}

#let link-icon(color: "#12283a", size: 9pt) = {
  let svg = "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"2 7 20 10\" fill=\"" + color + "\"><path d=\"M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1M8 13h8v-2H8zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5\"/></svg>"
  box(baseline: 10%, image(bytes(svg), width: size))
}

#let email-icon(color: "#12283a", size: 9pt) = {
  let svg = "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 20 20\" fill=\"" + color + "\"><path d=\"M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z\"/></svg>"
  box(baseline: 12%, image(bytes(svg), width: size))
}

// Helper: parse basic markdown links [label](url) in text
#let render-text(text) = {
  let parts = ()
  let last-pos = 0
  let matches = text.matches(regex("\[(.*?)\]\((.*?)\)"))
  for m in matches {
    if m.start > last-pos {
      parts.push(text.slice(last-pos, m.start))
    }
    let label = m.captures.at(0)
    let url = m.captures.at(1)
    if url.starts-with("/") {
      url = "https://noeldemartin.com" + url
    }
    parts.push(link(url)[#label])
    last-pos = m.end
  }
  if last-pos < text.len() {
    parts.push(text.slice(last-pos))
  }
  parts.join()
}

// Headings: styled for the CV; level-2 entries are PDF bookmarks only
#show heading.where(level: 1): it => {
  v(1.1em)
  text(size: 19pt, weight: "medium", fill: color-blue-darker, tracking: -0.02em)[#it.body]
  v(0.25em)
}

// Job/education entries: PDF outline only, not rendered in the body
#show heading.where(level: 2): none

#let cv-heading(title) = heading(level: 1, outlined: false, bookmarked: true)[#title]

#let start-year(entry) = {
  let start = entry.at("startDate", default: "")
  if type(start) == str and start != "" {
    start.split("-").at(0)
  } else {
    ""
  }
}

#let bookmark-entry(year, role, place) = {
  if year != "" {
    year + " - " + role + " at " + place
  } else {
    role + " at " + place
  }
}

#let bookmarked-job(title) = heading(level: 2, outlined: false, bookmarked: true)[#title]

// CV Card Component: logo + header in 2 columns; body spans full width
#let cv-card(
  title: "",
  subtitle: "",
  note: none,
  url: none,
  period: "",
  location: none,
  image-path: none,
  summary: none,
  highlights: (),
  technologies: (),
) = {
  let logo-size = 30pt
  block(width: 100%, breakable: false)[
    #grid(
      columns: (logo-size, 1fr),
      align: (horizon),
      column-gutter: 10pt,
      // Row 1: Logo + header
      box(
        width: logo-size,
        height: logo-size,
        image(image-path, width: logo-size, height: logo-size, fit: "contain")
      ),
      grid(
        columns: (1fr, auto),
        column-gutter: 8pt,
        align: (top + left, top + right),
        [
          #text(weight: "bold", size: 11pt, fill: color-black)[#title] \
          #link(url)[#text(size: 9.5pt, fill: color-blue-darkest)[#subtitle]]
        ],
        [
          #text(fill: color-grey-darker, weight: "regular", size: 9.5pt)[#period] \
          #if location != none and location != "" [
            #location-icon(color: "#606f7b", size: 8.5pt)
            #h(1pt)
            #text(fill: color-grey-darker, size: 9pt)[#location]
          ]
        ]
      ),
      // Row 2: body content spans both columns
      grid.cell(colspan: 2)[
        #v(10pt)

        #if summary != none and summary != "" [
          #text(size: 10pt, fill: color-black-light)[#render-text(summary)]
        ]

        #if highlights.len() > 0 [
            #grid(
                columns: (auto, 1fr),
                h(6pt),
                list(
                    marker: text(fill: color-grey-dark)[•],
                    spacing: 1em,
                    ..highlights.map(h => text(size: 10pt, fill: color-black-light)[#render-text(h)])
                )
            )
        ]

        #if note != none and note != "" [
          #v(0.25em)
          #text(size: 8.5pt, style: "italic", fill: color-black-light)[Note: #note]
        ]

        #if technologies.len() > 0 [
          #v(0.25em)
          #text(size: 9pt)[
            #text(weight: "bold", fill: color-blue-darkest)[Technologies:] #text(fill: color-grey-darkest)[#technologies.join(", ").]
          ]
        ]
      ]
    )
  ]
}

#let work-entry(job) = {
  let img-path = "../../public" + job.image
  let subtitle = if job.at("position", default: "") != job.name {
    job.name
  } else {
    job.at("displayUrl", default: job.at("url", default: ""))
  }

  bookmarked-job(bookmark-entry(start-year(job), job.position, job.name))
  cv-card(
    title: job.position,
    subtitle: subtitle,
    note: job.at("note", default: none),
    url: job.at("url", default: none),
    period: job.at("dateDisplay", default: job.period),
    location: job.at("location", default: none),
    image-path: img-path,
    summary: job.at("summary", default: none),
    highlights: job.at("highlights", default: ()),
    technologies: job.at("technologies", default: ()),
  )
  v(0.85em)
}

#let project-entry(project) = {
  let img-path = "../../public" + project.image
  let project-display = project.url.replace(regex("^https?://"), "").replace(regex("/$"), "")

  cv-card(
    title: project.name,
    subtitle: project-display,
    url: project.url,
    image-path: img-path,
    summary: project.at("description", default: none),
    highlights: project.at("highlights", default: ()),
    technologies: project.at("technologies", default: ()),
  )
  v(0.85em)
}

#let education-entry(edu) = {
  let img-path = "../../public" + edu.image

  bookmarked-job(bookmark-entry(
    start-year(edu),
    edu.at("studyType", default: edu.area),
    edu.institution,
  ))
  cv-card(
    title: edu.at("studyType", default: edu.area),
    subtitle: edu.institution,
    url: edu.at("url", default: none),
    period: edu.at("dateDisplay", default: edu.period),
    location: edu.at("location", default: none),
    image-path: img-path,
    summary: edu.at("summary", default: none),
    highlights: edu.at("highlights", default: ()),
    technologies: edu.at("technologies", default: ()),
  )
  v(0.85em)
}

// ==========================================
// HEADER
// ==========================================
#let site-display = cv.basics.url.replace(regex("^https?://"), "").replace(regex("/$"), "")

#grid(
  columns: (1fr, auto),
  column-gutter: 14pt,
  align: (horizon, horizon),
  [
    #text(size: 24pt, weight: "medium", fill: color-blue-darkest, tracking: -0.02em)[#cv.basics.name] \
    #v(-0.8em)
    #text(size: 12pt, weight: "regular", fill: color-blue-darker)[#cv.basics.label]
  ],
  [
    #v(3pt)
    #grid(
      columns: (auto, auto),
      column-gutter: 5pt,
      row-gutter: 4pt,
      align: (center + horizon, left + horizon),
      location-icon(color: "#12283a", size: 11pt),
      text(size: 9.5pt, fill: color-blue-darkest)[#cv.basics.location.address],
      link-icon(color: "#12283a", size: 11pt),
      link(cv.basics.url)[#site-display],
      email-icon(color: "#12283a", size: 11pt),
      link("mailto:" + cv.basics.email)[#cv.basics.email],
    )
  ]
)

// ==========================================
// SUMMARY
// ==========================================
#v(1em)
#text(size: 10pt, fill: color-grey-darker)[#render-text(cv.basics.summary)]
#v(-2em)

// ==========================================
// WORK HISTORY
// ==========================================
#let jobs = cv.at("work", default: ())
#if jobs.len() > 0 [
  // Keep heading (+ intro) with the first entry so it can't orphan at a page break
  #block(breakable: false)[
    #cv-heading("Work History")
    #v(-2em)
    #text(size: 9pt, style: "italic", fill: color-grey-darker)[#render-text(cv.at("workIntro", default: ""))]
    #v(0.5em)
    #work-entry(jobs.at(0))
  ]
  #for job in jobs.slice(1) [
    #work-entry(job)
  ]
]

// ==========================================
// SIDE PROJECTS & OPEN SOURCE
// ==========================================
#let projects = cv.at("projects", default: ())
#if projects.len() > 0 [
  #block(breakable: false)[
    #cv-heading("Side Projects & Open Source")
    #project-entry(projects.at(0))
  ]
  #for project in projects.slice(1) [
    #project-entry(project)
  ]
]

// ==========================================
// EDUCATION
// ==========================================
#let education = cv.at("education", default: ())
#if education.len() > 0 [
  #block(breakable: false)[
    #cv-heading("Education")
    #education-entry(education.at(0))
  ]
  #for edu in education.slice(1) [
    #education-entry(edu)
  ]
]
