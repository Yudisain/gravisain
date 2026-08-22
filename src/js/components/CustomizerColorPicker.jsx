import React, { useState, useEffect, useRef } from 'react';
import { createRoot } from 'react-dom/client';
import { createPortal } from 'react-dom';
import { SketchPicker } from 'react-color';

/**
 * A robust Popover implementation for the Color Picker that uses React Portal
 * to escape Customizer container bounds and prevent scrollbar issues.
 */
const CustomizerColorPicker = ({ initialColor, onChange, onClear, presetColors = [] }) => {
    const [color, setColor] = useState(initialColor || 'transparent');
    const [isOpen, setIsOpen] = useState(false);
    const [popoverStyle, setPopoverStyle] = useState({ top: 0, left: 0, opacity: 0 });
    const popoverRef = useRef(null);
    const buttonRef = useRef(null);

    useEffect(() => {
        setColor(initialColor || 'transparent');
    }, [initialColor]);

    useEffect(() => {
        const handleClickOutside = (event) => {
            if (popoverRef.current && !popoverRef.current.contains(event.target) && !buttonRef.current.contains(event.target)) {
                setIsOpen(false);
            }
        };

        const handleScrollOrResize = () => {
            if (isOpen) setIsOpen(false);
        };

        if (isOpen) {
            document.addEventListener('mousedown', handleClickOutside);
            window.addEventListener('resize', handleScrollOrResize);
            
            // Listen to scroll on Customizer sidebar
            const scrollContainer = document.querySelector('.wp-full-overlay-sidebar-content');
            if (scrollContainer) {
                scrollContainer.addEventListener('scroll', handleScrollOrResize, { passive: true });
            }

            // Calculate position relative to viewport
            if (buttonRef.current) {
                const rect = buttonRef.current.getBoundingClientRect();
                const popoverHeight = 330; // Approximate height
                const popoverWidth = 225; // Approximate SketchPicker width
                
                let topPos = rect.bottom + 8;
                let leftPos = rect.right - popoverWidth;

                // Open upwards if it goes below screen
                if (rect.bottom + popoverHeight > window.innerHeight && rect.top > popoverHeight) {
                    topPos = rect.top - popoverHeight - 8;
                }

                // Ensure it doesn't go off left edge
                if (leftPos < 10) leftPos = 10;

                setPopoverStyle({
                    top: `${topPos}px`,
                    left: `${leftPos}px`,
                    opacity: 1, // Show after position is calculated
                });
            }
        } else {
            document.removeEventListener('mousedown', handleClickOutside);
            window.removeEventListener('resize', handleScrollOrResize);
            const scrollContainer = document.querySelector('.wp-full-overlay-sidebar-content');
            if (scrollContainer) {
                scrollContainer.removeEventListener('scroll', handleScrollOrResize);
            }
        }
        
        return () => {
            document.removeEventListener('mousedown', handleClickOutside);
            window.removeEventListener('resize', handleScrollOrResize);
            const scrollContainer = document.querySelector('.wp-full-overlay-sidebar-content');
            if (scrollContainer) {
                scrollContainer.removeEventListener('scroll', handleScrollOrResize);
            }
        };
    }, [isOpen]);

    const handleColorChange = (newColor) => {
        const c = newColor.rgb.a === 1 ? newColor.hex : `rgba(${newColor.rgb.r}, ${newColor.rgb.g}, ${newColor.rgb.b}, ${newColor.rgb.a})`;
        setColor(c);
        if (onChange) onChange(c);
    };

    const handleClear = () => {
        setColor('transparent');
        if (onClear) onClear();
        setIsOpen(false);
    };

    return (
        <div style={{ display: 'inline-block' }}>
            <button
                ref={buttonRef}
                type="button"
                className="gravisain-color-indicator"
                style={{
                    backgroundColor: color !== 'transparent' ? color : 'transparent',
                    width: '30px',
                    height: '30px',
                    borderRadius: '50%',
                    border: '1px solid #ccc',
                    padding: 0,
                    minWidth: 0,
                    boxShadow: 'inset 0 0 0 1px rgba(0,0,0,0.1)',
                    cursor: 'pointer',
                    display: 'block'
                }}
                onClick={() => setIsOpen(!isOpen)}
                aria-expanded={isOpen}
            />
            {isOpen && createPortal(
                <div ref={popoverRef} style={{
                    position: 'fixed',
                    zIndex: 999999,
                    top: popoverStyle.top,
                    left: popoverStyle.left,
                    opacity: popoverStyle.opacity,
                    background: '#fff',
                    borderRadius: '4px',
                    boxShadow: '0 2px 10px rgba(0,0,0,0.2)',
                    padding: '0',
                    transition: 'opacity 0.1s ease'
                }}>
                    <SketchPicker
                        color={color !== 'transparent' ? color : '#ffffff'}
                        onChange={handleColorChange}
                        presetColors={presetColors}
                        styles={{ default: { picker: { boxShadow: 'none', border: 'none' } } }}
                    />
                    <div style={{ padding: '10px', borderTop: '1px solid #eee', textAlign: 'center' }}>
                        <button 
                            type="button" 
                            className="button"
                            onClick={handleClear}
                        >
                            Clear
                        </button>
                    </div>
                </div>,
                document.body
            )}
        </div>
    );
};

export const mountColorPicker = (element, options) => {
    // Determine preset colors from global window object if available
    let presetColors = [];
    if (window.GravisainCustomizerOptions && window.GravisainCustomizerOptions.palette) {
        presetColors = window.GravisainCustomizerOptions.palette;
    } else if (window.GravisainFonts && window.GravisainFonts.palette) {
        presetColors = window.GravisainFonts.palette;
    }

    let root = element.__reactRoot;
    if (!root) {
        root = createRoot(element);
        element.__reactRoot = root;
    }
    root.render(
        <CustomizerColorPicker
            initialColor={options.initialColor}
            onChange={options.onChange}
            onClear={options.onClear}
            presetColors={presetColors}
        />
    );
    return root;
};
